<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Expenses\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Expenses\Repositories\ExpenseCategoryRepository;
use FI\Modules\Expenses\Repositories\ExpenseVendorRepository;

class ExpenseLookupController extends Controller
{
    private $expenseCategoryRepository;
    private $expenseVendorRepository;

    public function __construct(
        ExpenseCategoryRepository $expenseCategoryRepository,
        ExpenseVendorRepository $expenseVendorRepository
    )
    {
        $this->expenseCategoryRepository = $expenseCategoryRepository;
        $this->expenseVendorRepository   = $expenseVendorRepository;
    }

    public function lookupCategory()
    {
        return $this->expenseCategoryRepository->lookupByName(request('query'));
    }

    public function lookupVendor()
    {
        return $this->expenseVendorRepository->lookupByName(request('query'));
    }
}