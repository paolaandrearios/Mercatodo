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

    public static function generateSlug(string $category_name): string
    {
        $slug = str_replace(' ', '-', trim($category_name));
        return strtolower($slug);
    }
}
