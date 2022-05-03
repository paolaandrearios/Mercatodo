<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
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
        $products = null;
        if(!is_null($this->category)) {
            $products = Product::query()
                ->with('categories')
                ->whereHas('categories', function($query) {
                    $query->where('category_id', $this->category);
                });
        } else {
            $products = Product::query()->with('categories');
        }

        if(!is_null($this->status)) {
            $products = $products->where('status', $this->status);
        }


        return $products->get();

    }


}
