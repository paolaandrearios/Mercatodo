<?php

namespace App\Http\Controllers\Api\Admin;

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

        $products = $this->productRepository->get($request->input('keyword')??'');

        return response()->json(compact('products'));
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        $data = $request->all();
        $data['slug'] =  Helper::generateSlug($data['name_en']);

        $file_name = time().'_'.$request->image->getClientOriginalName();
        $file_path = $request->file('image')->storeAs('products', $file_name, 'public');

        $data['image'] = '/storage/' . $file_path;

        $product = Product::create($data);

        $product->categories()->attach($request->input('categoryId'));

        return response()->json([
            'product' => $product,
            'message' => __('general.api.product.create_status_success'),
        ]);
    }


    public function show(Product $product): JsonResponse
    {
        return response()->json(compact('product'));
    }


    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $data = $request->all();
        $data['slug'] =  Helper::generateSlug($data['name_en']);

        if ($request->image) {
            $file_name = time().'_'.$request->image->getClientOriginalName();
            $file_path = $request->file('image')->storeAs('products', $file_name, 'public');

            $data['image'] = '/storage/' . $file_path;
        }

        if ($product->update($data)) {
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
