<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    private string $status;

    public function __construct(String $status)
    {
        $this->status = $status;
    }

    public function collection(): Collection
    {
        if($this->status === 'all'){
            return Product::all();
        } else {
            return Product::query()->where('status', $this->status)->get();
        }
    }
}
