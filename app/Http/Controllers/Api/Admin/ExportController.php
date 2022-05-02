<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportController extends Controller
{
   public function export(Request $request): BinaryFileResponse
   {
       $status = $request->query('status');
       return Excel::download(new ProductExport($status),'products.xlsx');
   }
}
