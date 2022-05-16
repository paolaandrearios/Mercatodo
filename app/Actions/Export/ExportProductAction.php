<?php

namespace App\Actions\Export;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Services\WebcheckoutService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

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
            'stock'
        ];

        $products = Product::query()->with(['categories', 'images'])
            ->select($data_product)
            ->whereDate('created_at', '>=', $initialDate)
            ->whereDate('created_at', '<=', $endDate);

        if(!is_null($category)) {
            $products = $products->whereHas('categories', function($query) use ($category) {
                $query->select('category_id')->where('category_id', $category);
            });
        }

        if(!is_null($status)) {
            $products = $products->where('status', $status);
        }

        return $products->get();
    }

}
