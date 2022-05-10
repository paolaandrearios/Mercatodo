<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use App\Models\User;
use App\Notifications\ImportHasFailedNotification;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;

class ImportController extends Controller
{
    public function import(Request $request): void
    {
        $authUser = auth()->user();
        $user = User::query()->where('id',$authUser['id'])->first();
        $importedBy = app(User::class, $user->toArray());
        $importFile =  $request->file('products');
        $fileName = time() . '_' . $importFile->getClientOriginalName();

        try{
            Excel::import(
                new ProductImport($importedBy),
                $importFile,
                $importFile->storeAs('imported-products', $fileName, 'public')
            );
        }catch (ValidationException  $e){
            $user->notify(new ImportHasFailedNotification($e->errors(), $importFile->getClientOriginalName()));
        }
    }
}
