<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Payments\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Modules\Payments\Repositories\PaymentRepository;
use FI\Support\Parser;
use FI\Validators\SendEmailValidator;

class PaymentMailController extends Controller
{
    private $mailQueue;
    private $mailQueueRepository;
    private $paymentRepository;
    private $sendEmailValidator;

    public function __construct(
        MailQueue $mailQueue,
        MailQueueRepository $mailQueueRepository,
        PaymentRepository $paymentRepository,
        SendEmailValidator $sendEmailValidator)
    {
        $this->mailQueue           = $mailQueue;
        $this->mailQueueRepository = $mailQueueRepository;
        $this->paymentRepository   = $paymentRepository;
        $this->sendEmailValidator  = $sendEmailValidator;
    }

    public function create()
    {
        $payment = $this->paymentRepository->find(request('payment_id'));

        $parser = new Parser($payment);

        return view('payments._modal_mail')
            ->with('paymentId', $payment->id)
            ->with('redirectTo', request('redirectTo'))
            ->with('to', $payment->invoice->client->email)
            ->with('cc', config('fi.mailDefaultCc'))
            ->with('bcc', config('fi.mailDefaultBcc'))
            ->with('subject', $parser->parse('paymentReceiptEmailSubject'))
            ->with('body', $parser->parse('paymentReceiptBody'));
    }

    public function store()
    {
        $validator = $this->sendEmailValidator->getValidator(request()->all());

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'  => $validator->messages()->toArray(),
            ], 400);
        }

        $payment = $this->paymentRepository->find(request('payment_id'));

        $mail = $this->mailQueueRepository->create($payment, request()->except('payment_id'));

        if (!$this->mailQueue->send($mail->id))
        {
            return response()->json(['errors' => [[$this->mailQueue->getError()]]], 400);
        }
    }
}