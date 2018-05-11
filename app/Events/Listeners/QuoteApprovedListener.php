<?php

namespace FI\Events\Listeners;

use FI\Events\QuoteApproved;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Modules\Quotes\Repositories\QuoteInvoiceRepository;
use FI\Support\DateFormatter;
use FI\Support\Parser;

class QuoteApprovedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        MailQueue $mailQueue,
        MailQueueRepository $mailQueueRepository,
        QuoteInvoiceRepository $quoteInvoiceRepository)
    {
        $this->mailQueue              = $mailQueue;
        $this->mailQueueRepository    = $mailQueueRepository;
        $this->quoteInvoiceRepository = $quoteInvoiceRepository;
    }

    /**
     * Handle the event.
     *
     * @param  QuoteApproved $event
     * @return void
     */
    public function handle(QuoteApproved $event)
    {
        // Create the activity record
        $event->quote->activities()->create(['activity' => 'public.approved']);

        // If applicable, convert the quote to an invoice when quote is approved
        if (config('fi.convertQuoteWhenApproved'))
        {
            $this->quoteInvoiceRepository->quoteToInvoice(
                $event->quote,
                date('Y-m-d'),
                DateFormatter::incrementDateByDays(date('Y-m-d'), config('fi.invoicesDueAfter')),
                config('fi.invoiceGroup')
            );
        }

        $parser = new Parser($event->quote);

        $mail = $this->mailQueueRepository->create($event->quote, [
            'to'         => $event->quote->user->email,
            'cc'         => config('fi.mailDefaultCc'),
            'bcc'        => config('fi.mailDefaultBcc'),
            'subject'    => trans('fi.quote_status_change_notification'),
            'body'       => $parser->parse('quoteApprovedEmailBody'),
            'attach_pdf' => config('fi.attachPdf')
        ]);

        $this->mailQueue->send($mail->id);
    }
}
