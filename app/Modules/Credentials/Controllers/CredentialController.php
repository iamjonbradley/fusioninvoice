<?php

/**
 * This file is an addon to FusionInvoice by Amber Orchard.
 *
 * (c) Amber Orchard, LLC <jonathan@amberorchard.com>
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

class CredentialController extends Controller
{
    use ReturnUrl;

    private $credentialRepository;
    private $credentialValidator;

    private $types = [
        'Database'  => 'Database', 
        'FTP'       => 'FTP', 
        'SSH'       => 'SSH', 
        'WordPress' => 'WordPress', 
        'Magento'   => 'Magento', 
        'WordPress' => 'WordPress', 
        'Hosting'   => 'Hosting', 
        'GoDaddy'   => 'GoDaddy'
    ];

    public function __construct(
        ClientRepository $clientRepository,
        CredentialRepository $credentialRepository,
        CredentialValidator $credentialValidator
    )
    {
        $this->clientRepository = $clientRepository;
        $this->credentialRepository = $credentialRepository;
        $this->credentialValidator = $credentialValidator;
    }

    public function index()
    {
        $this->setReturnUrl();

        return view('credentials.index')
            ->with('credentials', $this->credentialRepository->paginate())
            ->with('displaySearch', true);
    }

    public function show($id)
    {
        $this->setReturnUrl();

        return view('credentials.view')
            ->with('credential', $this->credentialRepository->find($id));
    }

    public function delete($id)
    {
        $this->credentialRepository->delete($id);

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('fi.record_deleted_successfully'));
    }

    public function ajax_delete()
    {
        $this->credentialRepository->delete(request('id'));

        return response()->json(['success' => true], 200);
    }
}