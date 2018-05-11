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

class CredentialCreateController extends Controller
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

    public function create()
    {
        return view('credentials.form')
            ->with('types', $this->credentialRepository->types)
            ->with('editMode', false)
            ->with('clients', $this->clientRepository->lists());
    }

    public function store()
    {
        $validator = $this->credentialValidator->getValidator(request()->all());

        if ($validator->fails())
        {
            return redirect()->route('credentials.create')
                ->with('editMode', false)
                ->withErrors($validator)
                ->withInput();
        }

        $client = $this->clientRepository->firstOrCreate(request('client_name'));

        $this->credentialRepository->create(request()->all(), $client);

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('fi.record_successfully_created'));
    }

    public function ajax_store()
    {
        $validator = $this->credentialValidator->getValidatorAjax(request()->all());

        if ($validator->fails())
        {
            return response()->json([
                'success' => false,
                'errors'  => $validator->messages()->toArray(),
            ], 400);
        }

        $client = $this->clientRepository->find(request('client_id'));

        $credential = $this->credentialRepository->create(request()->all(), $client);

        return view('credentials._credential')
            ->with('credential', $credential);
    }
}