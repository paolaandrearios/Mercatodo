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

class ProductImport implements ToModel, WithValidation, WithHeadingRow
{
    public function model(array $row): Product
    {
        $row['slug'] = Helper::generateSlug(Arr::get($row, 'name_en'));
        $product = new Product($row);

        $product->save();

        $product->categories()->attach($row['category_id']);
        $product->images()->saveMany([
            $product->images[0] = new Image(['url'=> $row['images'], 'product_id' => $product->id]),
        ]);

        return $product;
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function prepareForValidation(array $row): array
    {
        $conversions = [
            ['current' => __('general.web.product.name_en'), 'base' => 'name_en'],
            ['current' => __('general.web.product.description_en'), 'base' => 'description_en'],
            ['current' => __('general.web.product.name_es'), 'base' => 'name_es'],
            ['current' => __('general.web.product.description_es'), 'base' => 'description_es'],
            ['current' => __('general.web.product.price'), 'base' => 'price'],
            ['current' => __('general.web.product.taxes'), 'base' => 'taxes'],
            ['current' => __('general.web.product.status'), 'base' => 'status'],
            ['current' => __('general.web.product.stock'), 'base' => 'stock'],
            ['current' => __('general.web.category.category'), 'base' => 'category_id'],
            ['current' => __('general.web.product.images'), 'base' => 'images'],
        ];

        foreach ($conversions as $conversion){
            $row = Helper::replace_key($row, $conversion['current'], $conversion['base']);
        }

        return $row;
    }

    public function rules(): array
    {
        return ProductRules::toArray();
    }

}

