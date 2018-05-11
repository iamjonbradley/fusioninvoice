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
use FI\Modules\Reports\Repositories\PaymentsCollectedReportRepository;
use FI\Modules\Reports\Validators\ReportValidator;
use FI\Support\PDF\PDFFactory;

class PaymentsCollectedReportController extends Controller
{
    private $paymentsCollectedReportRepository;
    private $reportValidator;

    public function __construct(
        PaymentsCollectedReportRepository $paymentsCollectedReportRepository,
        ReportValidator $reportValidator
    )
    {
        $this->paymentsCollectedReportRepository = $paymentsCollectedReportRepository;
        $this->reportValidator                   = $reportValidator;
    }

    public function index()
    {
        return view('reports.options.payments_collected');
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
        $results = $this->paymentsCollectedReportRepository->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id')
        );

        return view('reports.output.payments_collected')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();
        $pdf->setPaperOrientation('landscape');

        $results = $this->paymentsCollectedReportRepository->getResults(
            request('from_date'),
            request('to_date'),
            request('company_profile_id')
        );

        $html = view('reports.output.payments_collected')
            ->with('results', $results)->render();

        $pdf->download($html, trans('fi.payments_collected') . '.pdf');
    }
}