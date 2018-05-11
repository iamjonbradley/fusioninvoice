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

use FI\Events\InvoiceModified;
use FI\Http\Controllers\Controller;
use FI\Modules\Expenses\Repositories\ExpenseRepository;
use FI\Modules\Expenses\Validators\ExpenseBillValidator;
use FI\Modules\Expenses\Validators\ExpenseValidator;
use FI\Modules\Invoices\Repositories\InvoiceItemRepository;
use FI\Modules\Invoices\Repositories\InvoiceRepository;

class ExpenseBillController extends Controller
{
    private $expenseBillValidator;
    private $expenseRepository;
    private $expenseValidator;
    private $invoiceItemRepository;
    private $invoiceRepository;

    public function __construct(
        ExpenseBillValidator $expenseBillValidator,
        ExpenseRepository $expenseRepository,
        ExpenseValidator $expenseValidator,
        InvoiceItemRepository $invoiceItemRepository,
        InvoiceRepository $invoiceRepository
    )
    {
        $this->expenseBillValidator  = $expenseBillValidator;
        $this->expenseRepository     = $expenseRepository;
        $this->expenseValidator      = $expenseValidator;
        $this->invoiceItemRepository = $invoiceItemRepository;
        $this->invoiceRepository     = $invoiceRepository;
    }

    public function create()
    {
        $expense = $this->expenseRepository->find(request('id'));

        $clientInvoices = $expense->client->invoices()->orderBy('created_at', 'desc')->statusIn([
            'draft',
            'sent',
        ])->get();

        $invoices = [];

        foreach ($clientInvoices as $invoice)
        {
            $invoices[$invoice->id] = $invoice->formatted_created_at . ' - ' . $invoice->number . ' ' . $invoice->summary;
        }

        return view('expenses._modal_bill')
            ->with('expense', $expense)
            ->with('invoices', $invoices)
            ->with('redirectTo', request('redirectTo'));
    }

    public function store()
    {
        $validator = $this->expenseBillValidator->getValidator(request()->all());

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'  => $validator->messages()->toArray(),
            ], 400);
        }

        $expense = $this->expenseRepository->find(request('id'));

        $this->expenseRepository->updateRaw(['invoice_id' => request('invoice_id')], request('id'));

        if (request('add_line_item'))
        {
            $item = [
                'invoice_id'       => request('invoice_id'),
                'item_name'        => request('item_name'),
                'item_description' => request('item_description'),
                'item_quantity'    => 1,
                'item_price'       => $expense->formatted_numeric_amount,
            ];

            $this->invoiceItemRepository->saveItems([$item]);

            event(new InvoiceModified($this->invoiceRepository->find(request('invoice_id'))));
        }
    }
}