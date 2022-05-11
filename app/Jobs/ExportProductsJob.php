<?php

namespace App\Jobs;

use App\Exports\ProductExport;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private ?string $status;
    private ?string $category;
    private string $locale;

    public function __construct(string $status = null, string $category = null, string $locale)
    {
        $this->status = $status;
        $this->category = $category;
        $this->locale = $locale;
    }

    public function handle()
    {
        if(!is_null($this->category)){
            $product_category = Category::query()->where('id', $this->category)->first();
            $name_category = $product_category['name_'.$this->locale];
        }

        $filePath = '';
        if(is_null($this->category)){
            $filePath = '/exported-products/'.time().'_'.$this->status.'_products.xlsx';
        } else if(is_null($this->status)){
            $filePath = '/exported-products/'.time().'_'.$name_category.'_products.xlsx';
        } else if(is_null($this->status) && is_null($this->category)){
            $filePath = '/exported-products/'.time().'_products.xlsx';
        } else {
            $filePath = '/exported-products/'.time().'_'.$name_category.'_'.$this->status.'_products.xlsx';
        }

        return Excel::store(new ProductExport($this->status, $this->category, $this->locale),$filePath,'public');
    }
}
