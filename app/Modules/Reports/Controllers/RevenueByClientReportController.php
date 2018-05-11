<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Reports\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Reports\Repositories\RevenueByClientReportRepository;
use FI\Modules\Reports\Validators\ReportValidator;
use FI\Support\DateFormatter;
use FI\Support\PDF\PDFFactory;

class RevenueByClientReportController extends Controller
{
    private $revenueByClientReportRepository;
    private $reportValidator;

    public function __construct(
        RevenueByClientReportRepository $revenueByClientReportRepository,
        ReportValidator $reportValidator
    )
    {
        $this->revenueByClientReportRepository = $revenueByClientReportRepository;
        $this->reportValidator                 = $reportValidator;
    }

    public function index()
    {
        $range = range(date('Y'), date('Y') - 5);

        return view('reports.options.revenue_by_client')
            ->with('years', array_combine($range, $range));
    }

    public function ajaxValidate()
    {
        $validator = $this->reportValidator->getYearValidator(request()->all());

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'  => $validator->messages()->toArray(),
            ], 400);
        }

        return response()->json(['success' => true]);
    }

    public function html()
    {
        $results = $this->revenueByClientReportRepository->getResults(request('company_profile_id'), request('year'));

        $months = [];

        foreach (range(1, 12) as $month)
        {
            $months[$month] = DateFormatter::getMonthShortName($month);
        }

        return view('reports.output.revenue_by_client')
            ->with('results', $results)
            ->with('months', $months);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();
        $pdf->setPaperOrientation('landscape');

        $results = $this->revenueByClientReportRepository->getResults(request('company_profile_id'), request('year'));

        $months = [];

        foreach (range(1, 12) as $month)
        {
            $months[$month] = DateFormatter::getMonthShortName($month);
        }

        $html = view('reports.output.revenue_by_client')
            ->with('results', $results)
            ->with('months', $months)
            ->render();

        $pdf->download($html, trans('fi.revenue_by_client') . '.pdf');
    }
}