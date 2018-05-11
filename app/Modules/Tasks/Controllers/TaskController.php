<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Tasks\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Invoices\Repositories\OverdueInvoiceRepository;
use FI\Modules\Invoices\Repositories\UpcomingDueInvoiceRepository;
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceRepository;
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceScheduleRepository;

class TaskController extends Controller
{
    private $overdueInvoiceRepository;
    private $recurringInvoiceRepository;
    private $upcomingDueInvoiceRepository;

    public function __construct(
        OverdueInvoiceRepository $overdueInvoiceRepository,
        RecurringInvoiceRepository $recurringInvoiceRepository,
        UpcomingDueInvoiceRepository $upcomingDueInvoiceRepository)
    {
        $this->overdueInvoiceRepository     = $overdueInvoiceRepository;
        $this->recurringInvoiceRepository   = $recurringInvoiceRepository;
        $this->upcomingDueInvoiceRepository = $upcomingDueInvoiceRepository;
    }

    public function run()
    {
        $this->overdueInvoiceRepository->queueOverdueInvoices();

        $this->upcomingDueInvoiceRepository->queueUpcomingInvoices();

        $this->recurringInvoiceRepository->recurInvoices();
    }
}