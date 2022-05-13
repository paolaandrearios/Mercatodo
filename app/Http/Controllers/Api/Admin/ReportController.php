<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GenerateReportRequest;
use App\Jobs\ReportsJob;
use App\Models\User;
use App\Repositories\ReportRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    private ReportRepository $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function generate(GenerateReportRequest $request)
    {
        $authUser = auth()->user();
        $reportBy = User::query()->where('id',$authUser['id'])->first();

        $initialDate = $request->query('initial-date');
        $endDate = $request->query('end-date');
        $reportOption = $request->query('report-option');
        $locale =  $request->headers->get('locale');

        $reports = $this->reportRepository->get($initialDate, $endDate, $reportOption);

        $this->dispatch(new ReportsJob($reportOption, $reports, $locale, $reportBy));

        return response()->json(['message' => __('general.api.data_management.report_status')]);
    }
}
