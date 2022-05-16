<?php

namespace App\Exports;

use App\Actions\Export\ExportProductAction;
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
        return (new ExportProductAction())->execute($this->initialDate, $this->endDate, $this->category, $this->status);
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

        for ($i = 0; $i <= 4; $i++) {
            $image = '';
            if (isset($product->images[$i])) {
                $image = public_path() . '/' . $product->images[$i]['url'];
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
            $this->getTranslation('name_en'),
            $this->getTranslation('description_en'),
            $this->getTranslation('name_es'),
            $this->getTranslation('description_es'),
            $this->getTranslation('price'),
            $this->getTranslation('taxes'),
            __('general.web.category.category', [], $this->locale),
            $this->getTranslation('status'),
            $this->getTranslation('stock'),
            $this->getTranslation('images0'),
            $this->getTranslation('images1'),
            $this->getTranslation('images2'),
            $this->getTranslation('images3'),
            $this->getTranslation('images4'),
        ];
    }

    private function getTranslation($field)
    {
        return __("general.web.product.{$field}", [], $this->locale);
    }
}
