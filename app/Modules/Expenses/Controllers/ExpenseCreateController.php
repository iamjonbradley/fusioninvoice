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
use FI\Modules\Attachments\Repositories\AttachmentRepository;
use FI\Modules\CompanyProfiles\Repositories\CompanyProfileRepository;
use FI\Modules\Expenses\Repositories\ExpenseRepository;
use FI\Modules\Expenses\Validators\ExpenseValidator;
use FI\Support\DateFormatter;
use FI\Traits\ReturnUrl;

class ExpenseCreateController extends Controller
{
    use ReturnUrl;

    private $attachmentRepository;
    private $companyProfileRepository;
    private $expenseRepository;
    private $expenseValidator;

    public function __construct(
        AttachmentRepository $attachmentRepository,
        CompanyProfileRepository $companyProfileRepository,
        ExpenseRepository $expenseRepository,
        ExpenseValidator $expenseValidator
    )
    {
        $this->attachmentRepository     = $attachmentRepository;
        $this->companyProfileRepository = $companyProfileRepository;
        $this->expenseRepository        = $expenseRepository;
        $this->expenseValidator         = $expenseValidator;
    }

    public function create()
    {
        return view('expenses.form')
            ->with('editMode', false)
            ->with('companyProfiles', $this->companyProfileRepository->lists())
            ->with('currentDate', DateFormatter::format(date('Y-m-d')));
    }

    public function store()
    {
        $validator = $this->expenseValidator->getValidator(request()->all());

        if ($validator->fails())
        {
            return redirect()->route('expenses.create')
                ->with('editMode', false)
                ->withErrors($validator)
                ->withInput();
        }

        $this->expenseRepository->create(request()->all());

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('fi.record_successfully_created'));
    }
}