<?php

namespace App\Jobs;

use App\Imports\ProductImport;
use App\Models\User;
use App\Notifications\ImportHasFailedNotification;
use App\Notifications\ProductsWereImported;
use Exception;
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


    public function handle()
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
            $user->notify((new ProductsWereImported($fileName))->locale($this->locale));
        }catch (ValidationException  $e){
            $user->notify((new ImportHasFailedNotification($e->errors(), explode('_',$this->importFilePath)[1]))->locale($this->locale));
            return ValidationException::class;
        }catch (Exception $e){
            return Exception::class;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getImportFilePath(): string
    {
        return $this->importFilePath;
    }


}
