<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithMapping, WithHeadings, ShouldQueue
{
    private ?string $status;
    private ?string $category;
    private string $initialDate;
    private string $endDate;
    private string $locale;

    public function __construct(String $status = null, String $category = null, string $locale, $initialDate, $endDate)
    {
        $this->status = $status;
        $this->category = $category;
        $this->locale = $locale;
        $this->initialDate = $initialDate;
        $this->endDate = $endDate;
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
                })->whereDate('created_at', '>=', $this->initialDate)
                ->whereDate('created_at', '<=', $this->endDate);
        } else {
            $products = Product::query()->with(['categories', 'images'])->select($data_product)->whereDate('created_at', '>=', $this->initialDate)
                ->whereDate('created_at', '<=', $this->endDate);;
        }

        if(!is_null($this->status)) {
            $products = $products->select($data_product)->where('status', $this->status)->whereDate('created_at', '>=', $this->initialDate)
                ->whereDate('created_at', '<=', $this->endDate);
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
            __('general.web.product.name_en', [], $this->locale),
            __('general.web.product.description_en', [], $this->locale),
            __('general.web.product.name_es', [], $this->locale),
            __('general.web.product.description_es', [], $this->locale),
            __('general.web.product.price', [], $this->locale),
            __('general.web.product.taxes', [], $this->locale),
            __('general.web.category.category', [], $this->locale),
            __('general.web.product.status', [], $this->locale),
            __('general.web.product.stock', [], $this->locale),
            __('general.web.product.images0', [], $this->locale),
            __('general.web.product.images1', [], $this->locale),
            __('general.web.product.images2', [], $this->locale),
            __('general.web.product.images3', [], $this->locale),
            __('general.web.product.images4', [], $this->locale),
        ];
    }
}
