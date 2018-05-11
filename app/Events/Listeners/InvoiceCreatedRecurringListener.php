<?php

namespace FI\Events\Listeners;

use FI\Events\InvoiceEmailed;
use FI\Events\InvoiceCreatedRecurring;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Support\Parser;

class InvoiceCreatedRecurringListener
{
    public function __construct(MailQueue $mailQueue, MailQueueRepository $mailQueueRepository)
    {
        $this->mailQueue           = $mailQueue;
        $this->mailQueueRepository = $mailQueueRepository;
    }

    public function handle(InvoiceCreatedRecurring $event)
    {
        if (config('fi.automaticEmailOnRecur') and $event->invoice->client->email)
        {
            $parser = new Parser($event->invoice);

            if (!$event->invoice->is_overdue)
            {
                $subject = $parser->parse('invoiceEmailSubject');
                $body    = $parser->parse('invoiceEmailBody');
            }
            else
            {
                $subject = $parser->parse('overdueInvoiceEmailSubject');
                $body    = $parser->parse('overdueInvoiceEmailBody');
            }

            $mail = $this->mailQueueRepository->create($event->invoice, [
                'to'         => $event->invoice->client->email,
                'cc'         => config('fi.mailDefaultCc'),
                'bcc'        => config('fi.mailDefaultBcc'),
                'subject'    => $subject,
                'body'       => $body,
                'attach_pdf' => config('fi.attachPdf')
            ]);

            $this->mailQueue->send($mail->id);

            event(new InvoiceEmailed($event->invoice));
        }
    }
}
