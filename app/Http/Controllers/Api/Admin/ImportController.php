<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request): JsonResponse
    {
        $importFile =  $request->file('products');
        $fileName = time() . '_' . $importFile->getClientOriginalName();
        if(Excel::import(new ProductImport,$importFile, $importFile->storeAs('importedProducts', $fileName, 'public'))){
            return response()->json([
                'message' => __('general.api.data_management.import_status_success'),
            ]);
        }
    }
}
