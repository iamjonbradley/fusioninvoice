<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\MailQueue\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;

class MailLogController extends Controller
{
    private $mailQueueRepository;

    public function __construct(MailQueueRepository $mailQueueRepository)
    {
        $this->mailQueueRepository = $mailQueueRepository;
    }

    public function index()
    {
        return view('mail_log.index')
            ->with('mails', $this->mailQueueRepository->paginate(request('search')))
            ->with('displaySearch', true);
    }

    public function delete($clientId)
    {
        $this->mailQueueRepository->delete($clientId);

        return redirect()->route('mailLog.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }
}