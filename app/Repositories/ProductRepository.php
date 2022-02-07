<?php


namespace App\Repositories;


use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository
{
    public function get(string $keyword = null, string $status = null, $statusCategory = null): LengthAwarePaginator
    {
        $products = Product::with('categories');

        if(!empty($keyword)) {
            $products = $products
                ->where('name_es', 'like', "%$keyword%")
                ->orWhere('name_en', 'like', "%$keyword%")
                ->orWhere('price', 'like', "$keyword%");
        }

        if(!is_null($status)) {
            $products = $products->where('status', $status);
        }

        if(!is_null($statusCategory)){
            $products = $products->whereRelation('categories', function ($query) use ($statusCategory) {
                $query->from('categories')->where('status', 'Like',  $statusCategory);
            });
        }

        return $products->orderBy('id', 'asc')->paginate(config('general.custom_records_per_page'));
    }
}
