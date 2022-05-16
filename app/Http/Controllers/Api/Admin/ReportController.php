<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GenerateReportRequest;
use App\Jobs\ReportsJob;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{

    public function __construct()
    {
    }

    public function generate(GenerateReportRequest $request): JsonResponse
    {
        $authUser = auth()->user();
        $reportBy = User::query()->where('id',$authUser['id'])->first();

        $initialDate = $request->query('initial-date');
        $endDate = $request->query('end-date');
        $reportOption = $request->query('report-option');
        $locale =  $request->headers->get('locale');

        $this->dispatch(new ReportsJob($reportOption, $locale, $reportBy, $initialDate, $endDate));

        return response()->json([
            'message' => __('general.api.data_management.report_status'),
        ]);
    }
}
