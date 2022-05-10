<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProductsJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ImportController extends Controller
{
    public function import(Request $request): JsonResponse
    {
        $authUser = auth()->user();
        $importFile =  $request->file('products');
        $fileName = time() . '_' . $importFile->getClientOriginalName();

        $importFilePath = $importFile->storeAs('imported-products', $fileName, 'public');

        $this->dispatch(new ImportProductsJob($authUser, $importFilePath, $request->headers->get('locale')));

        return response()->json(['message' => __('general.api.data_management.import_status')]);
    }
}
