<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
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

        $products = $this->productRepository->get($request->input('keyword')??'', 'active', 'active');

        return response()->json(compact('products'));
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json(compact('product'));
    }

}
