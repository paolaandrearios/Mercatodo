<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SearchProductRequest;
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
        $products = $this->productRepository->get(
            implode(':', $request->query()),
            $request->input('keyword') ?? '',
            'active',
            'active',
            $request->input('category') ?? ''
        );

        return response()->json(compact('products'));
    }

    public function show($slug): JsonResponse
    {
        $product = Product::with('images', 'categories')
            ->where('slug', $slug)
            ->where('stock', '>', 0)
            ->firstOrFail();

        return response()->json(compact('product'));
    }
}
