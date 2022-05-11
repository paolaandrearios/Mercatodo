<?php

namespace App\Jobs;

use App\Imports\ProductImport;
use App\Models\User;
use App\Notifications\ImportHasFailedNotification;
use App\Notifications\ProductsWereImported;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class ImportProductsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $importFilePath;
    private Authenticatable $authUser;
    private string $locale;

    public function __construct(Authenticatable $authUser, string $importFilePath, string $locale)
    {
        $this->importFilePath = $importFilePath;
        $this->authUser = $authUser;
        $this->locale = $locale;
    }


    public function handle(): void
    {
        $user = User::query()->where('id',$this->authUser['id'])->first();
        $importedBy = app(User::class, $user->toArray());

        try{
            $importFile = public_path() . '/storage/' . $this->importFilePath;
            Excel::import(
                new ProductImport($importedBy, $this->locale),
                $importFile
            );
            $fileName = explode('_',$this->importFilePath)[1];
            $user->notify(new ProductsWereImported($fileName));

        }catch (ValidationException  $e){
            $user->notify(new ImportHasFailedNotification($e->errors(), explode('_',$this->importFilePath)[1]));
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            Log::debug(json_encode($e));
        }
    }
}
