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

use FI\Http\Controllers\Controller;
use FI\Modules\Quotes\Repositories\QuoteCalculateRepository;

class QuoteRecalculateController extends Controller
{
    private $quoteCalculateRepository;

    public function __construct(QuoteCalculateRepository $quoteCalculateRepository)
    {
        $this->quoteCalculateRepository = $quoteCalculateRepository;
    }

    public function recalculate()
    {
        try
        {
            $this->quoteCalculateRepository->calculateAll();
        }
        catch (\Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => trans('fi.recalculation_complete'),
        ], 200);
    }
}