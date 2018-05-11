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
use FI\Modules\Reports\Repositories\ProfitLossReportRepository;
use FI\Modules\Reports\Validators\ReportValidator;
use FI\Support\PDF\PDFFactory;

class ProfitLossReportController extends Controller
{
    private $profitLossReportRepository;
    private $reportValidator;

    public function __construct(
        ProfitLossReportRepository $profitLossReportRepository,
        ReportValidator $reportValidator
    )
    {
        $this->profitLossReportRepository = $profitLossReportRepository;
        $this->reportValidator            = $reportValidator;
    }

    public function index()
    {
        return view('reports.options.profit_loss');
    }

    public function ajaxValidate()
    {
        $validator = $this->reportValidator->getDateRangeValidator(request()->all());

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
        $results = $this->profitLossReportRepository->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id')
        );

        return view('reports.output.profit_loss')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();

        $results = $this->profitLossReportRepository->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id')
        );

        $html = view('reports.output.profit_loss')
            ->with('results', $results)->render();

        $pdf->download($html, trans('fi.profit_and_loss') . '.pdf');
    }
}