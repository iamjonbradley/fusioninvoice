<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Import\Importers;

use FI\Modules\Clients\Repositories\ClientRepository;
use FI\Modules\Clients\Validators\ClientValidator;
use FI\Modules\CustomFields\Repositories\ClientCustomRepository;
use FI\Modules\CustomFields\Repositories\CustomFieldRepository;

class ClientImporter extends AbstractImporter
{
    private $clientCustomRepository;
    private $clientRepository;
    private $clientValidator;
    private $customFieldRepository;

    public function __construct(
        ClientCustomRepository $clientCustomRepository,
        ClientRepository $clientRepository,
        ClientValidator $clientValidator,
        CustomFieldRepository $customFieldRepository
    )
    {
        parent::__construct();
        $this->clientCustomRepository = $clientCustomRepository;
        $this->clientRepository       = $clientRepository;
        $this->clientValidator        = $clientValidator;
        $this->customFieldRepository  = $customFieldRepository;
    }

    public function getFields()
    {
        $fields = [
            'name'        => '* ' . trans('fi.name'),
            'unique_name' => trans('fi.unique_name'),
            'address'     => trans('fi.address'),
            'city'        => trans('fi.city'),
            'state'       => trans('fi.state'),
            'zip'         => trans('fi.postal_code'),
            'country'     => trans('fi.country'),
            'phone'       => trans('fi.phone'),
            'fax'         => trans('fi.fax'),
            'mobile'      => trans('fi.mobile'),
            'email'       => trans('fi.email'),
            'web'         => trans('fi.web'),
        ];

        foreach ($this->customFieldRepository->getByTable('clients') as $customField)
        {
            $fields['custom_' . $customField->column_name] = $customField->field_label;
        }

        return $fields;
    }

    public function getMapRules()
    {
        return ['name' => 'required'];
    }

    public function getValidator($input)
    {
        return $this->clientValidator->getImportValidator($input);
    }

    public function importData($input)
    {
        $row = 1;

        $fields       = [];
        $customFields = [];

        foreach ($input as $key => $field)
        {
            if (is_numeric($field))
            {
                if (substr($key, 0, 7) != 'custom_')
                {
                    $fields[$key] = $field;
                }
                else
                {
                    $customFields[substr($key, 7)] = $field;
                }
            }
        }

        try
        {
            $handle = fopen(storage_path('clients.csv'), 'r');
        }

        catch (\ErrorException $e)
        {
            $this->messages->add('error', 'Could not open the file');

            return false;
        }

        while (($data = fgetcsv($handle, 1000, ',')) !== false)
        {
            if ($row !== 1)
            {
                $record = [];

                $customRecord = [];

                foreach ($fields as $field => $key)
                {
                    $record[$field] = $data[$key];
                }

                if ($this->validateRecord($record))
                {
                    $client = $this->clientRepository->create($record);
                }

                if ($customFields)
                {
                    foreach ($customFields as $field => $key)
                    {
                        $customRecord[$field] = $data[$key];
                    }

                    $this->clientCustomRepository->save($customRecord, $client->id);
                }
            }

            $row++;
        }

        fclose($handle);

        return true;
    }
}