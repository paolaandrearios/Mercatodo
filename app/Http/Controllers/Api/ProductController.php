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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
