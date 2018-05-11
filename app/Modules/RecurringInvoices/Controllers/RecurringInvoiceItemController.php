<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\RecurringInvoices\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceItemRepository;

class RecurringInvoiceItemController extends Controller
{
    private $recurringInvoiceItemRepository;

    public function __construct(RecurringInvoiceItemRepository $recurringInvoiceItemRepository)
    {
        $this->recurringInvoiceItemRepository = $recurringInvoiceItemRepository;
    }

    public function delete()
    {
        $this->recurringInvoiceItemRepository->delete(request('id'));
    }
}