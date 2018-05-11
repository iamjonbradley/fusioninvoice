<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Invoices\Repositories;

use Carbon\Carbon;
use FI\Events\OverdueNoticeEmailed;
use FI\Modules\Invoices\Models\Invoice;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Support\BaseRepository;
use FI\Support\Parser;
use FI\Support\Statuses\InvoiceStatuses;
use Illuminate\Support\Facades\Log;

class OverdueInvoiceRepository extends BaseRepository
{
    private $mailQueue;
    private $mailQueueRepository;

    public function __construct(MailQueue $mailQueue, MailQueueRepository $mailQueueRepository)
    {
        $this->mailQueue           = $mailQueue;
        $this->mailQueueRepository = $mailQueueRepository;
    }

    public function queueOverdueInvoices()
    {
        $days = config('fi.overdueInvoiceReminderFrequency');

        if ($days)
        {
            $days = explode(',', $days);

            foreach ($days as $daysAgo)
            {
                $daysAgo = trim($daysAgo);

                if (is_numeric($daysAgo))
                {
                    $daysAgo = intval($daysAgo);

                    $date = Carbon::now()->subDays($daysAgo)->format('Y-m-d');

                    $invoices = Invoice::with('client')
                        ->where('invoice_status_id', '=', InvoiceStatuses::getStatusId('sent'))
                        ->whereHas('amount', function ($query)
                        {
                            $query->where('balance', '>', '0');
                        })
                        ->where('due_at', $date)
                        ->get();

                    Log::info('FI::MailQueue - Invoices found due ' . $daysAgo . ' days ago on ' . $date . ': ' . $invoices->count());

                    foreach ($invoices as $invoice)
                    {
                        $parser = new Parser($invoice);

                        $mail = $this->mailQueueRepository->create($invoice, [
                            'to'         => $invoice->client->email,
                            'cc'         => config('fi.mailDefaultCc'),
                            'bcc'        => config('fi.mailDefaultBcc'),
                            'subject'    => $parser->parse('overdueInvoiceEmailSubject'),
                            'body'       => $parser->parse('overdueInvoiceEmailBody'),
                            'attach_pdf' => config('fi.attachPdf'),
                        ]);

                        $this->mailQueue->send($mail->id);

                        event(new OverdueNoticeEmailed($invoice, $mail));
                    }
                }
                else
                {
                    Log::info('FI::MailQueue - Invalid overdue indicator: ' . $daysAgo);
                }
            }
        }

    }

}