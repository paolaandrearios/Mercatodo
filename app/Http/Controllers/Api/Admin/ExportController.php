<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ExportProductsJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ExportController extends Controller
{
   public function export(Request $request): JsonResponse
   {
       $status = $request->query('status');
       $category = $request->query('category');
       $locale =  $request->headers->get('locale');

       $this->dispatch(new ExportProductsJob($status, $category, $locale));

       return response()->json(['message' => __('general.api.data_management.export_status')]);
   }
}
