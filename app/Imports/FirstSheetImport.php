<?php

namespace App\Imports;

use App\Actions\Import\ImportProductAction;
use App\Helpers\Helper;
use App\Models\Product;
use App\Models\User;
use App\Rules\Api\Admin\ProductRules;
use Illuminate\Contracts\Queue\ShouldQueue;
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
        return (new ImportProductAction())->execute($row);
    }

    public function prepareForValidation(array $row): array
    {
        $conversions = [
            ['current' => $this->getTranslation('name_en'), 'base' => 'name_en'],
            ['current' => $this->getTranslation('description_en'), 'base' => 'description_en'],
            ['current' => $this->getTranslation('name_es'), 'base' => 'name_es'],
            ['current' => $this->getTranslation('description_es'), 'base' => 'description_es'],
            ['current' => $this->getTranslation('price'), 'base' => 'price'],
            ['current' => $this->getTranslation('taxes'), 'base' => 'taxes'],
            ['current' => $this->getTranslation('status'), 'base' => 'status'],
            ['current' => $this->getTranslation('stock'), 'base' => 'stock'],
            ['current' => __('general.web.category.category', [], $this->locale), 'base' => 'category_id'],
            ['current' => $this->getTranslation('images0'), 'base' => 'images0'],
            ['current' => $this->getTranslation('images1'), 'base' => 'images1'],
            ['current' => $this->getTranslation('images2'), 'base' => 'images2'],
            ['current' => $this->getTranslation('images3'), 'base' => 'images3'],
            ['current' => $this->getTranslation('images4'), 'base' => 'images4'],
        ];

        foreach ($conversions as $conversion) {
            $row = Helper::replace_key($row, $conversion['current'], $conversion['base']);
        }

        $status = trim(strtolower($row['status']));
        if ($status == strtolower(__('general.web.product.active', [], $this->locale))) {
            $status = 'active';
        }
        if ($status == strtolower(__('general.web.product.inactive', [], $this->locale))) {
            $status = 'inactive';
        }
        $row['status'] = $status;

        if (!is_null($row['id'])) {
            $product = Product::with(['categories', 'images'])->where('id', $row['id'])->first();
            if ($product['sku'] == $row['sku']
                || $product['name_es'] == $row['name_es']
                || $product['name_en'] == $row['name_en']) {
                $this->is_new_product = false;
            }
        }

        return $row;
    }

    public function rules(): array
    {
        if ($this->is_new_product === true) {
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

            return array_replace($base, $replacement);
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }

    private function getTranslation($field)
    {
        return __("general.web.product.{$field}", [], $this->locale);
    }
}
