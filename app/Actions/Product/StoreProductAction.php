<?php

namespace App\Actions\Product;

use App\Helpers\Helper;
use App\Http\Requests\Api\CreateProductRequest;
use App\Models\Image;
use App\Models\Product;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class StoreProductAction
{
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function execute(CreateProductRequest $request): Product
    {
        $product = new Product();

        $product->sku = $request->input('sku');
        $product->name_es = $request->input('name_es');
        $product->name_en = $request->input('name_en');
        $product->description_es = $request->input('description_es');
        $product->description_en = $request->input('description_en');
        $product->price = $request->input('price');
        $product->taxes = $request->input('taxes');
        $product->status = $request->input('status');
        $product->stock = $request->input('stock');

        $product->slug = Helper::generateSlug($product['name_en']);

        $product->save();

        $product->categories()->attach($request->input('category_id'));

        $this->imageUpload($request, $product);

        return $product;
    }

    public function imageUpload(Request $request, Product $product): void
    {
        foreach ($request->images as $image_product) {
            $image = new Image();

            $filePath = $this->imageRepository->upload('products', $image_product);
            $image->url = config('general.custom_image_path') . $filePath;
            $image->product_id = $product->id;
            $image->save();
        }
    }
}
