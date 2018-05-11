<?php

/**
 * This file is an addon to FusionInvoice by Amber Orchard.
 *
 * (c) Amber Orchard, LLC <jonathan@amberorchard.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Credentials\Repositories;

use FI\Modules\Credentials\Models\Credential;
use FI\Modules\Clients\Repositories\ClientRepository;

class CredentialRepository
{
    private $credentialRepository;

    public $types = [
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
        ClientRepository $clientRepository
    )
    {
        $this->clientRepository     = $clientRepository;
    }

    protected function buildQuery()
    {
        return Credential::select('credentials.*', 'clients.name AS client_name')
            ->leftJoin('clients', 'clients.id', '=', 'credentials.client_id');;
    }

    public function find($id)
    {
        return $this->buildQuery()->find($id);
    }

    public function paginate($filter = null)
    {
        return $this->buildQuery()
            ->sortable(['name' => 'asc'])
            ->paginate(config('fi.resultsPerPage'));
    }

    public function findIdByListIdentifier($listIdentifier)
    {
        print_R($listIdentifier);
        die;
        if ($credential = Credential::select('id')->where('id', $listIdentifier)->first())
        {
            return $credential->id;
        }

        return null;
    }

    public function create($input, $client, $unformat = true)
    {
        $credential = Credential::create([
            'client_id'         => $client->id,
            'user_id'           => $input['user_id'],
            'credential_type'   => $input['credential_type'],
            'name'              => $input['name'],
            'details'           => $input['details']
        ]);

        return $credential;
    } 


    public function update($input, $id)
    {
        $credential = credential::find($id);

        $credential->fill($input);

        $credential->save();

        return $credential;
    }

    public function delete($id)
    {
        Credential::destroy($id);
    }
}