<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Quotes\Controllers;

use FI\Events\QuoteEmailed;
use FI\Http\Controllers\Controller;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;
use FI\Modules\Quotes\Repositories\QuoteRepository;
use FI\Support\Parser;
use FI\Validators\SendEmailValidator;

class QuoteMailController extends Controller
{
    private $mailQueue;
    private $mailQueueRepository;
    private $quoteRepository;
    private $sendEmailValidator;

    public function __construct(
        MailQueue $mailQueue,
        MailQueueRepository $mailQueueRepository,
        QuoteRepository $quoteRepository,
        SendEmailValidator $sendEmailValidator)
    {
        $this->mailQueue           = $mailQueue;
        $this->mailQueueRepository = $mailQueueRepository;
        $this->quoteRepository     = $quoteRepository;
        $this->sendEmailValidator  = $sendEmailValidator;
    }

    public function create()
    {
        $quote = $this->quoteRepository->find(request('quote_id'));

        $parser = new Parser($quote);

        return view('quotes._modal_mail')
            ->with('quoteId', $quote->id)
            ->with('redirectTo', request('redirectTo'))
            ->with('to', $quote->client->email)
            ->with('cc', config('fi.mailDefaultCc'))
            ->with('bcc', config('fi.mailDefaultBcc'))
            ->with('subject', $parser->parse('quoteEmailSubject'))
            ->with('body', $parser->parse('quoteEmailBody'));
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

        $quote = $this->quoteRepository->find(request('quote_id'));

        $mail = $this->mailQueueRepository->create($quote, request()->except('quote_id'));

        if ($this->mailQueue->send($mail->id))
        {
            event(new QuoteEmailed($quote));
        }
        else
        {
            return response()->json(['errors' => [[$this->mailQueue->getError()]]], 400);
        }
    }
}