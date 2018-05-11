<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Credentials\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Clients\Repositories\ClientRepository;
use FI\Modules\Credentials\Repositories\CredentialRepository;
use FI\Modules\Credentials\Validators\CredentialValidator;
use FI\Traits\ReturnUrl;

class CredentialEditController extends Controller
{
    use ReturnUrl;

    private $credentialRepository;
    private $credentialValidator;

    public function __construct(
        ClientRepository $clientRepository,
        CredentialRepository $credentialRepository,
        CredentialValidator $credentialValidator
    )
    {
        $this->clientRepository     = $clientRepository;
        $this->credentialRepository = $credentialRepository;
        $this->credentialValidator  = $credentialValidator;
    }

    public function edit($id)
    {
        return view('credentials.form')
            ->with('types', $this->credentialRepository->types)
            ->with('editMode', true)
            ->with('clients', $this->clientRepository->lists())
            ->with('credential', $this->credentialRepository->find($id));
    }

    public function update($id)
    {
        $validator = $this->credentialValidator->getUpdateValidator(request()->all());

        if ($validator->fails())
        {
            return redirect()->route('credentials.edit', [$id])
                ->with('editMode', true)
                ->withErrors($validator)
                ->withInput();
        }

        $this->credentialRepository->update(request()->all(), $id);

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('fi.record_successfully_updated'));
    }
}