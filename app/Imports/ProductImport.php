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
    private string $locale;

    public function __construct(User $importedBy, string $locale)
    {
        $this->importedBy = $importedBy;
        $this->locale = $locale;
    }

    public function sheets(): array
    {
        return [
            new FirstSheetImport($this->importedBy, $this->locale),
        ];
    }
}

