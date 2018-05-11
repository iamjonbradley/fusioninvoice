<?php

namespace FI\Events\Listeners;

use FI\Events\PaymentCreated;
use FI\Modules\CustomFields\Models\PaymentCustom;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Support\Parser;

class PaymentCreatedListener
{
    public function __construct(MailQueue $mailQueue, MailQueueRepository $mailQueueRepository)
    {
        $this->mailQueue           = $mailQueue;
        $this->mailQueueRepository = $mailQueueRepository;
    }

    public function handle(PaymentCreated $event)
    {
        // Create the default custom record.
        $event->payment->custom()->save(new PaymentCustom());

        if (request('email_payment_receipt') == 'true'
            or (!request()->exists('email_payment_receipt') and config('fi.automaticEmailPaymentReceipts') and $event->payment->invoice->client->email))
        {
            $parser = new Parser($event->payment);

            $mail = $this->mailQueueRepository->create($event->payment, [
                'to'         => $event->payment->invoice->client->email,
                'cc'         => config('fi.mailDefaultCc'),
                'bcc'        => config('fi.mailDefaultBcc'),
                'subject'    => $parser->parse('paymentReceiptEmailSubject'),
                'body'       => $parser->parse('paymentReceiptBody'),
                'attach_pdf' => config('fi.attachPdf')
            ]);

            $this->mailQueue->send($mail->id);
        }
    }
}
