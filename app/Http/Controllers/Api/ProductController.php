<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * @return JsonResponse
     */

    public function index(): JsonResponse
    {
        $products = Product::orderBy('id', 'asc')->paginate();
        return response()->json(compact('products'));
    }

    /**
     * @param CreateProductRequest $request
     * @return JsonResponse
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        $data = $request->all();
        $data['slug'] =  Helper::generateSlug($data['name_en']);

        $file_name = time().'_'.$request->image->getClientOriginalName();
        $file_path = $request->file('image')->storeAs('products', $file_name, 'public');

        $data['image'] = '/storage/' . $file_path;

        $product = Product::create($data);

        return response()->json([
            'product' => $product,
            'message' => __('general.api.product.create_status_success'),
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }


    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $data = $request->all();
        $data['slug'] =  Helper::generateSlug($data['name_en']);
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
