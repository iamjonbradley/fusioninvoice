<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Controllers;

use FI\Events\InvoiceEmailed;
use FI\Http\Controllers\Controller;
use FI\Modules\Invoices\Repositories\InvoiceRepository;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Support\Parser;
use FI\Validators\SendEmailValidator;

class InvoiceMailController extends Controller
{
    private $sendEmailValidator;
    private $mailQueueRepository;
    private $mailQueue;
    private $invoiceRepository;

    public function __construct(
        InvoiceRepository $invoiceRepository,
        MailQueue $mailQueue,
        MailQueueRepository $mailQueueRepository,
        SendEmailValidator $sendEmailValidator)
    {
        $this->invoiceRepository   = $invoiceRepository;
        $this->mailQueue           = $mailQueue;
        $this->mailQueueRepository = $mailQueueRepository;
        $this->sendEmailValidator  = $sendEmailValidator;
    }

    public function create()
    {
        $invoice = $this->invoiceRepository->find(request('invoice_id'));

        $parser = new Parser($invoice);

        if (!$invoice->is_overdue)
        {
            $subject = $parser->parse('invoiceEmailSubject');
            $body    = $parser->parse('invoiceEmailBody');
        }
        else
        {
            $subject = $parser->parse('overdueInvoiceEmailSubject');
            $body    = $parser->parse('overdueInvoiceEmailBody');
        }

        return view('invoices._modal_mail')
            ->with('invoiceId', $invoice->id)
            ->with('redirectTo', request('redirectTo'))
            ->with('to', $invoice->client->email)
            ->with('cc', config('fi.mailDefaultCc'))
            ->with('bcc', config('fi.mailDefaultBcc'))
            ->with('subject', $subject)
            ->with('body', $body);
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

        $invoice = $this->invoiceRepository->find(request('invoice_id'));

        $mail = $this->mailQueueRepository->create($invoice, request()->except('invoice_id'));

        if ($this->mailQueue->send($mail->id))
        {
            event(new InvoiceEmailed($invoice));
        }
        else
        {
            return response()->json(['errors' => [[$this->mailQueue->getError()]]], 400);
        }
    }
}