<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ReportWasGenerated;
use App\Repositories\ReportRepository;
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
    private string $locale;
    private User $reportBy;
    private string $initialDate;
    private string $endDate;

    public function __construct(string $reportOption, string $locale, User $reportBy, string $initialDate, String $endDate)
    {
        $this->reportOption = $reportOption;
        $this->locale = $locale;
        $this->reportBy = $reportBy;
        $this->initialDate = $initialDate;
        $this->endDate = $endDate;
    }

    public function handle(ReportRepository $reportRepository): void
    {
        $reports = $reportRepository->get($this->initialDate, $this->endDate, $this->reportOption);

        $pdf = Pdf::loadView('admin.reports.' . $this->reportOption, [
            'reports' => $reports,
            'initialDate' => $this->initialDate,
            'endDate' => $this->endDate,
        ]);

        $fileName = time() . '_' . $this->reportOption . '.pdf';
        $pdf->save(public_path('storage/reports/' . $fileName));
        $this->reportBy->notify((new ReportWasGenerated($fileName))->locale($this->locale));
    }
}
