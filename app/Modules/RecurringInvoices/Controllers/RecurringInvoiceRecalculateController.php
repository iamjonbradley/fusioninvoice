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
use FI\Modules\RecurringInvoices\Repositories\RecurringInvoiceCalculateRepository;

class RecurringInvoiceRecalculateController extends Controller
{
    private $recurringInvoiceCalculateRepository;

    public function __construct(RecurringInvoiceCalculateRepository $recurringInvoiceCalculateRepository)
    {
        $this->recurringInvoiceCalculateRepository = $recurringInvoiceCalculateRepository;
    }

    public function recalculate()
    {
        try
        {
            $this->recurringInvoiceCalculateRepository->calculateAll();
        }
        catch (\Exception $e)
        {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }

        return response()->json(['success' => true, 'message' => trans('fi.recalculation_complete')], 200);
    }
}