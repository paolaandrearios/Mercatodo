<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\Image;
use App\Models\Product;
use App\Rules\Api\Admin\ProductRules;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


HeadingRowFormatter::default('none');

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = new Product([
            'sku' => Arr::get($row, __('general.web.product.sku')),
            'name_en' => Arr::get($row, __('general.web.product.name_en')),
            'description_en' => Arr::get($row, __('general.web.product.description_en')),
            'name_es' => Arr::get($row, __('general.web.product.name_es')),
            'description_es' => Arr::get($row, __('general.web.product.description_es')),
            'price' => Arr::get($row, __('general.web.product.price')),
            'taxes' => Arr::get($row, __('general.web.product.taxes')),
            'status' => Arr::get($row, __('general.web.product.status')),
            'stock' => Arr::get($row, __('general.web.product.stock')),
            'slug' => Helper::generateSlug($row[__('general.web.product.name_en')]),
        ]);

        $product->save();

        $product->categories()->attach(Arr::get($row, __('general.web.category.category')));
        $product->images()->saveMany([
            $product->images[0] = new Image(['url'=> Arr::get($row, __('general.web.product.images')), 'product_id' => $product->id]),
        ]);

        return $product;
    }

    public function headingRow(): int
    {
        return 2;
    }

//    public function rules(): array
//    {
//        return ProductRules::toArray();
//    }
}

