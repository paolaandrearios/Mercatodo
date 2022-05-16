<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductRepository
{
    public function get(string $key, string $keyword = null, string $status = null, $statusCategory = null, $category = ''): LengthAwarePaginator
    {
        $key = "product_query_:{$key}";
        Helper::setProductsKey($key);

        return Cache::remember($key, Carbon::now()->endOfDay(), function () use ($keyword, $status, $statusCategory, $category) {

            $products = Product::with('categories', 'images');

            if (!empty($keyword)) {
                $products = $products->where(function ($query) use ($keyword) {
                    $query->where('name_es', 'like', "%$keyword%")
                        ->orWhere('name_en', 'like', "%$keyword%")
                        ->orWhere('price', 'like', "$keyword%");
                });
            }

            if (!is_null($status)) {
                $products = $products->where('status', $status);
            }

            if (!is_null($statusCategory)) {
                $products = $products->whereRelation('categories', function ($query) use ($statusCategory, $category) {
                    $query->from('categories')->where('status', 'Like', $statusCategory);
                    if ($category !== '') {
                        $query->from('categories')->where('category_product.category_id', $category);
                    }
                });
            }

            $products = $products->where('stock', '>', 0);

            return $products->orderBy('id', 'asc')->paginate(config('general.custom_records_per_page'));
        });
    }
}
