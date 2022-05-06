<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ProductImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new FirstSheetImport(),
        ];
    }
}

