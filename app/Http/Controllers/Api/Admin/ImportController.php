<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request): void
    {
        $importFile =  $request->file('products');
        $fileName = time() . '_' . $importFile->getClientOriginalName();
        Excel::import(new ProductImport,$importFile, $importFile->storeAs('importedProducts', $fileName, 'public'));
    }
}
