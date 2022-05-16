<?php

namespace App\Actions\Import;

use App\Helpers\Helper;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Arr;

class ImportProductAction
{
    public function execute(array $row)
    {
        Helper::forgetProducts();

        $row['slug'] = Helper::generateSlug(Arr::get($row, 'name_en'));
        $row['id'] = Arr::get($row, 'id');
        $row['sku'] = Arr::get($row, 'sku');
        if (!is_null($row['id'])) {
            $product = Product::with(['categories', 'images'])->where('id', $row['id'])->first();
            $product->update($row);
            $product->categories()->sync($row['category_id']);
            $product->images()->delete();
        } else {
            $product = new Product($row);
            $product->save();
            $product->categories()->attach($row['category_id']);
        }

        for ($i = 0; $i < 5; $i++) {
            $currentImage = $row['images' . $i];
            if (!is_null($currentImage)) {
                $filePath = 'imported-products/imported-images/' . time() . '.jpg';
                try {
                    copy($currentImage, storage_path('/app/public/' . $filePath));
                    $image = (new Image(['url'=> 'storage/' . $filePath, 'product_id' => $product->id]))->save();
                } catch (\Exception $err) {
                    $file = file_exists(storage_path('/app/public/' . $filePath));
                    $image = (new Image(['url'=> '/images/new-product.jpg', 'product_id' => $product->id]))->save();
                    $product['status'] = 'inactive';
                }
            }
        }

        return $product;
    }
}
