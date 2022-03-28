<?php

namespace App\Actions\Product;

use App\Helpers\Helper;
use App\Models\Image;
use App\Models\Product;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class UpdateProductAction
{
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function execute(Product $product, Request $request): bool
    {
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

        $product->categories()->sync($request->input('category_id'));

        $this->imageUpdateUpload($request, $product);

        return $product->save();
    }

    public function imageUpdateUpload(Request $request, Product $product): void
    {
        $updated_images = explode(',', $request->updated_images);

        if ($request->images !== null) {
            foreach ($request->images as $index => $image_product) {
                if ($updated_images[$index] === '') {
                    $image = new Image();
                } else {
                    $image = Image::where('id', $updated_images[$index])->first();
                }

                $filePath = $this->imageRepository->upload('products', $image_product);
                $image->url = config('general.custom_image_path') . $filePath;
                $image->product_id = $product->id;
                $image->save();
            }
        }
    }
}
