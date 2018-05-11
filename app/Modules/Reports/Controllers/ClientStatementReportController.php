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
use FI\Modules\Reports\Repositories\ClientStatementReportRepository;
use FI\Modules\Reports\Validators\ClientStatementReportValidator;
use FI\Support\PDF\PDFFactory;

class ClientStatementReportController extends Controller
{
    private $clientStatementReportRepository;
    private $clientStatementReportValidator;

    public function __construct(
        ClientStatementReportRepository $clientStatementReportRepository,
        ClientStatementReportValidator $clientStatementReportValidator
    )
    {
        $this->clientStatementReportRepository = $clientStatementReportRepository;
        $this->clientStatementReportValidator  = $clientStatementReportValidator;
    }

    public function index()
    {
        return view('reports.options.client_statement');
    }

    public function ajaxValidate()
    {
        $validator = $this->clientStatementReportValidator->getValidator(request()->all());

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
        $results = $this->clientStatementReportRepository->getResults(
            request('client_name'),
            request('from_date'),
            request('to_date'),
            request('company_profile_id'));

        return view('reports.output.client_statement')
            ->with('results', $results);
    }

    public function pdf()
    {
        $pdf = PDFFactory::create();
        $pdf->setPaperOrientation('landscape');

        $results = $this->clientStatementReportRepository->getResults(
            request('client_name'),
            request('from_date'),
            request('to_date'),
            request('company_profile_id'));

        $html = view('reports.output.client_statement')
            ->with('results', $results)->render();

        $pdf->download($html, trans('fi.client_statement') . '.pdf');
    }
}