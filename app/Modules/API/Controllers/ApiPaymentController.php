<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\API\Controllers;

use FI\Modules\Invoices\Repositories\InvoiceRepository;
use FI\Modules\Payments\Repositories\PaymentRepository;
use FI\Modules\Payments\Validators\PaymentValidator;

class ApiPaymentController extends ApiController
{
    private $invoiceRepository;
    private $paymentRepository;
    private $paymentValidator;

    public function __construct(
        InvoiceRepository $invoiceRepository,
        PaymentRepository $paymentRepository,
        PaymentValidator $paymentValidator)
    {
        parent::__construct();
        $this->invoiceRepository = $invoiceRepository;
        $this->paymentRepository = $paymentRepository;
        $this->paymentValidator  = $paymentValidator;
    }

    public function lists()
    {
        return response()->json($this->paymentRepository->paginate([], null, request('client_id'), request('invoice_id'), request('invoice_number')));
    }

    public function show()
    {
        if ($payment = $this->paymentRepository->find(request('id')))
        {
            return response()->json($payment);
        }

        return response()->json([trans('fi.record_not_found')], 400);
    }

    public function create()
    {
        $input = request()->except('key', 'signature', 'timestamp', 'endpoint');

        if (!$this->invoiceRepository->find($input['invoice_id']))
        {
            return response()->json([trans('fi.record_not_found')], 400);
        }

        $validator = $this->paymentValidator->getValidator($input);

        if ($validator->fails())
        {
            return response()->json($validator->errors()->all(), 400);
        }

        return response()->json($this->paymentRepository->create($input, false));
    }

    public function delete()
    {
        $validator = $this->validator->make(request()->only(['id']), ['id' => 'required']);

        if ($validator->fails())
        {
            return response()->json($validator->errors()->all(), 400);
        }

        if ($this->paymentRepository->find(request('id')))
        {
            $this->paymentRepository->delete(request('id'));

            return response(200);
        }

        return response()->json([trans('fi.record_not_found')], 400);
    }
}