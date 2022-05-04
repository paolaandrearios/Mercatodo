<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithMapping, WithHeadings
{
    private ?string $status;
    private ?string $category;

    public function __construct(String $status = null, String $category = null)
    {
        $this->status = $status;
        $this->category = $category;
    }

    public function collection(): Collection
    {
        $data_product = [
            'id',
            'sku',
            'name_en',
            'description_en',
            'name_es',
            'description_es',
            'price',
            'taxes',
            'status',
            'stock'
        ];
        $products = null;
        if(!is_null($this->category)) {
            $products = Product::query()
                ->with(['categories', 'images'])
                ->select($data_product)
                ->whereHas('categories', function($query) {
                    $query->select('category_id')->where('category_id', $this->category);
                });
        } else {
            $products = Product::query()->with(['categories', 'images'])->select($data_product);
        }

        if(!is_null($this->status)) {
            $products = $products->select($data_product)->where('status', $this->status);
        }

        return $products->get();
    }

    public function map($product): array
    {
        $result = [
            $product->id,
            $product->sku,
            $product->name_en,
            $product->description_en,
            $product->name_es,
            $product->description_es,
            $product->price,
            $product->taxes,
            $product->categories[0]['id'],
            $product->status,
            $product->stock,
        ];

        for($i = 0; $i <= 4; $i++){
            $image = '';
            if(isset($product->images[$i])){
                $image = public_path()."/".$product->images[$i]['url'];
            }
            $result[] = $image;
        }

        return $result;
    }

    public function headings(): array
    {
        return [
            'id',
            'sku',
            __('general.web.product.name_en'),
            __('general.web.product.description_en'),
            __('general.web.product.name_es'),
            __('general.web.product.description_es'),
            __('general.web.product.price'),
            __('general.web.product.taxes'),
            __('general.web.category.category'),
            __('general.web.product.status'),
            __('general.web.product.stock'),
            __('general.web.product.images0'),
            __('general.web.product.images1'),
            __('general.web.product.images2'),
            __('general.web.product.images3'),
            __('general.web.product.images4'),
        ];
    }
}
