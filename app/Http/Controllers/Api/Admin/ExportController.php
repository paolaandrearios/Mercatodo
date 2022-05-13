<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ExportProductsJob;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ExportController extends Controller
{
   public function export(Request $request): JsonResponse
   {
       $authUser = auth()->user();
       $exportedBy = User::query()->where('id',$authUser['id'])->first();

       $status = $request->query('status');
       $category = $request->query('category');
       $initialDate = $request->query('initial-date');
       $endDate = $request->query('end-date');
       $locale =  $request->headers->get('locale');


       $this->dispatch(new ExportProductsJob($status, $category, $locale, $exportedBy, $initialDate, $endDate));

       return response()->json(['message' => __('general.api.data_management.export_status')]);
   }
}
