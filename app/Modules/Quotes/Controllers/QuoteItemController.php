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
use FI\Modules\Quotes\Repositories\QuoteItemRepository;

class QuoteItemController extends Controller
{
    private $quoteItemRepository;

    public function __construct(QuoteItemRepository $quoteItemRepository)
    {
        $this->quoteItemRepository = $quoteItemRepository;
    }

    public function delete()
    {
        $this->quoteItemRepository->delete(request('id'));
    }
}