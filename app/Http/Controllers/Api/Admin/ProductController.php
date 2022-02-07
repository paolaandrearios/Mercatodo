<?php

namespace App\Http\Controllers\Api\Admin;

use App\Actions\Product\StoreProductAction;
use App\Actions\Product\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateProductRequest;
use App\Http\Requests\Api\SearchProductRequest;
use App\Http\Requests\Api\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;


class ProductController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(SearchProductRequest $request): JsonResponse
    {

        $products = $this->productRepository->get($request->input('keyword')??'');

        return response()->json(compact('products'));
    }

    public function store(CreateProductRequest $request, StoreProductAction $storeProductAction): JsonResponse
    {
        return response()->json([
            'product' => $storeProductAction->execute($request),
            'message' => __('general.api.product.create_status_success'),
        ]);
    }


    public function show(Product $product): JsonResponse
    {
        return response()->json(compact('product'));
    }


    public function update(UpdateProductRequest $request, Product $product, UpdateProductAction $updateProductAction): JsonResponse
    {
        if ($updateProductAction->execute($product, $request)) {
            $product->categories()->sync($request->input('categoryId'));

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
