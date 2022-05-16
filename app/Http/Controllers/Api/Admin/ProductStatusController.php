<?php

namespace App\Http\Controllers\Api\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StatusProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductStatusController extends Controller
{
    public function update(StatusProductRequest $request, Product $product, string $status): JsonResponse
    {
        Helper::forgetProducts();

        $data = [
            'status' => $status,
        ];

        if ($product->update($data)) {
            return response()->json([
                'message' => __('general.api.product.update_status_success'),
            ]);
        } else {
            return response()->json([
                'message' => __('general.api.product.update_status_error'),
            ]);
        }
    }
}
