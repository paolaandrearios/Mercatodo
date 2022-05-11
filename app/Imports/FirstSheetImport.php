<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use App\Rules\Api\Admin\ProductRules;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class FirstSheetImport implements ToModel, WithValidation, WithHeadingRow, WithChunkReading, ShouldQueue
{
    private bool $is_new_product = true;
    private User $importedBy;
    private string $locale;

    public function __construct(User $importedBy, string $locale)
    {
        $this->importedBy = $importedBy;
        $this->locale = $locale;
    }

    public function model(array $row): Product
    {
        $row['slug'] = Helper::generateSlug(Arr::get($row, 'name_en'));
        $row['id'] = Arr::get($row, 'id');
        $row['sku'] = Arr::get($row, 'sku');
        if(!is_null($row['id'])){
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
            if(!is_null($currentImage)) {
                $filePath = 'imported-products/imported-images/'.time().'.jpg';
                try {
                    copy($currentImage, storage_path('/app/public/' . $filePath));
                    $image = (new Image(['url'=> 'storage/' . $filePath, 'product_id' => $product->id]))->save();
                } catch(\Exception $err) {
                    $file = file_exists(storage_path('/app/public/' . $filePath));
                    $image = (new Image(['url'=> '/images/new-product.jpg' , 'product_id' => $product->id]))->save();
                    $product['status'] = 'inactive';
                }
            }
        }

        return $product;
    }

    public function prepareForValidation(array $row): array
    {
        $conversions = [
            ['current' => __('general.web.product.name_en', [], $this->locale), 'base' => 'name_en'],
            ['current' => __('general.web.product.description_en', [], $this->locale), 'base' => 'description_en'],
            ['current' => __('general.web.product.name_es', [], $this->locale), 'base' => 'name_es'],
            ['current' => __('general.web.product.description_es', [], $this->locale), 'base' => 'description_es'],
            ['current' => __('general.web.product.price', [], $this->locale), 'base' => 'price'],
            ['current' => __('general.web.product.taxes', [], $this->locale), 'base' => 'taxes'],
            ['current' => __('general.web.product.status', [], $this->locale), 'base' => 'status'],
            ['current' => __('general.web.product.stock', [], $this->locale), 'base' => 'stock'],
            ['current' => __('general.web.category.category', [], $this->locale), 'base' => 'category_id'],
            ['current' => __('general.web.product.images0', [], $this->locale), 'base' => 'images0'],
            ['current' => __('general.web.product.images1', [], $this->locale), 'base' => 'images1'],
            ['current' => __('general.web.product.images2', [], $this->locale), 'base' => 'images2'],
            ['current' => __('general.web.product.images3', [], $this->locale), 'base' => 'images3'],
            ['current' => __('general.web.product.images4', [], $this->locale), 'base' => 'images4'],
        ];

        foreach ($conversions as $conversion){
            $row = Helper::replace_key($row, $conversion['current'], $conversion['base']);
        }

        if(strtolower($row['status']) === strtolower(__('general.web.product.active'))){
            $row['status'] = str_replace($row['status'], strtolower('active'), $row['status']);
        }
        if(strtolower($row['status']) === strtolower(__('general.web.product.inactive'))){
            $row['status'] = str_replace($row['status'], strtolower('inactive'), $row['status']);
        }

        if(!is_null($row['id'])){
            $product = Product::with(['categories', 'images'])->where('id', $row['id'])->first();
            if($product['sku'] == $row['sku']
                || $product['name_es'] == $row['name_es']
                || $product['name_en'] == $row['name_en']){
                $this->is_new_product = false;
            }
        }

        return $row;
    }

    public function rules(): array
    {
        if($this->is_new_product === true){
            return ProductRules::toArray();
        } else {
            $base = ProductRules::toArray();
            $replacement = [
                'sku' => [
                    'required',
                    'alpha_num',
                    'min:5',
                    'max:10',
                ],
                'name_es' => [
                    'required',
                    'min:4',
                    'max:60',
                ],
                'name_en' => [
                    'required',
                    'min:4',
                    'max:60',
                ],
            ];

            return array_replace($base,$replacement);
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }
}

