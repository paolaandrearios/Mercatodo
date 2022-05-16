<?php

namespace App\Actions\Export;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ExportProductAction
{
    public function execute(string $initialDate, string $endDate, string $category = null, string $status = null): Collection
    {
        $data_product = [
            'id',
            'sku',
            'name_en',
            'description_en',
            'name_es',
            'description_es',
            'price',
            'taxes',
            'status',
            'stock',
        ];

        $products = Product::query()->with(['categories', 'images'])
            ->select($data_product)
            ->whereDate('created_at', '>=', $initialDate)
            ->whereDate('created_at', '<=', $endDate);

        if (!is_null($category)) {
            $products = $products->whereHas('categories', function ($query) use ($category) {
                $query->select('category_id')->where('category_id', $category);
            });
        }

        if (!is_null($status)) {
            $products = $products->where('status', $status);
        }

        return $products->get();
    }
}
