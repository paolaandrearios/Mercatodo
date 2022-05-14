<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ReportWasGenerated;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReportsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $reportOption;
    private array $reports;
    private string $locale;
    private User $reportBy;

    public function __construct(string $reportOption, array $reports, string $locale, User $reportBy)
    {
        $this->reportOption = $reportOption;
        $this->reports = $reports;
        $this->locale = $locale;
        $this->reportBy = $reportBy;
    }

    public function handle(): void
    {
        $pdf = Pdf::setPaper('a4', 'landscape')->loadView('admin.reports.'.$this->reportOption, ['reports' => $this->reports]);

        $pdf->save(public_path('storage/reports/'.time().'_'.$this->reportOption.'.pdf'));
        $fileName = time().'_'.$this->reportOption.'.pdf';
        $this->reportBy->notify((new ReportWasGenerated($fileName))->locale($this->locale));
    }
}
