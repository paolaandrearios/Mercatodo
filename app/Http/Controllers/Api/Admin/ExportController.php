<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
   public function export(): BinaryFileResponse
   {
        return Excel::download(new ProductExport,'products.xlsx');
   }
}
