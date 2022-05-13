<?php

namespace App\Jobs;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ReportsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $reportOption;
    private array $reports;
    private string $locale;
    private User $ReportBy;

    public function __construct(string $reportOption, array $reports, string $locale, User $ReportBy)
    {
        $this->reportOption = $reportOption;
        $this->reports = $reports;
        $this->locale = $locale;
        $this->ReportBy = $ReportBy;
    }

    public function handle(): void
    {
        $pdf = Pdf::loadView('admin.reports.'.$this->reportOption, ['reports' => $this->reports]);
        Log::debug($this->reports);
        Log::debug($this->reportOption);

        $pdf->save(public_path('storage/reports/'.time().'_'.$this->reportOption.'.pdf'));
    }
}
