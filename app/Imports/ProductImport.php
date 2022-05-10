<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ProductImport implements WithMultipleSheets
{
    private User $importedBy;

    public function __construct(User $importedBy)
    {
        $this->importedBy = $importedBy;
    }

    public function sheets(): array
    {
        return [
            new FirstSheetImport($this->importedBy),
        ];
    }
}

