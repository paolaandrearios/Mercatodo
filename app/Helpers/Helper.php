<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Helper
{
    public static function getTranslation()
    {
        return Cache::remember('translations', Carbon::now()->endOfDay(), function () {
            $translations = collect();

            foreach (['en', 'es'] as $locale) { // suported locales
                $translations[$locale] = [
                    'php' => self::phpTranslations($locale),
                    'json' => self::jsonTranslations($locale),
                ];
            }

            return $translations;
        });
    }

    private static function phpTranslations($locale): \Illuminate\Support\Collection
    {
        $path = resource_path("lang/$locale");

        return collect(File::allFiles($path))->flatMap(function ($file) use ($locale) {
            $key = ($translation = $file->getBasename('.php'));

            return [$key => trans($translation, [], $locale)];
        });
    }

    private static function jsonTranslations($locale): array
    {
        $path = resource_path("lang/$locale.json");

        if (is_string($path) && is_readable($path)) {
            return json_decode(file_get_contents($path), true);
        }

        return [];
    }

    public static function generateSlug(string $name): string
    {
        $slug = str_replace(' ', '-', trim($name));

        return strtolower($slug);
    }

    public static function replace_key(array $array, string $oldKey, string $newKey): array
    {
        if (array_key_exists($oldKey, $array)) {
            $keys = array_keys($array);
            $keys[array_search($oldKey, $keys)] = $newKey;

            return array_combine($keys, $array);
        }

        return $array;
    }

    public static function setProductsKey($key)
    {
        $queries = self::getProductsKey();
        if (in_array($key, $queries)) {
            return $queries;
        }
        Cache::forget('get_products_queries');
        array_push($queries, $key);

        return Cache::remember('get_products_queries', Carbon::now()->endOfDay(), function () use ($queries) {
            return $queries;
        });
    }

    public static function getProductsKey()
    {
        return Cache::remember('get_products_queries', Carbon::now()->endOfDay(), function () {
            return [];
        });
    }

    public static function forgetProducts()
    {
        $keys = self::getProductsKey();
        foreach ($keys as $key) {
            Cache::forget($key);
        }
        Cache::forget('get_products_queries');
    }
}
