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
use FI\Modules\CompanyProfiles\Models\CompanyProfile;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Quotes\Repositories\QuoteRepository;
use FI\Modules\Quotes\Validators\QuoteValidator;
use FI\Support\DateFormatter;
use FI\Support\Statuses\QuoteStatuses;

class QuoteImporter extends AbstractImporter
{
    private $clientRepository;
    private $groupRepository;
    private $quoteRepository;
    private $quoteValidator;

    public function __construct(
        ClientRepository $clientRepository,
        GroupRepository $groupRepository,
        QuoteRepository $quoteRepository,
        QuoteValidator $quoteValidator
    )
    {
        parent::__construct();
        $this->clientRepository = $clientRepository;
        $this->groupRepository  = $groupRepository;
        $this->quoteRepository  = $quoteRepository;
        $this->quoteValidator   = $quoteValidator;
    }

    public function getFields()
    {
        return [
            'created_at'      => '* ' . trans('fi.date'),
            'company_profile' => '* ' . trans('fi.company_profile'),
            'client_name'     => '* ' . trans('fi.client_name'),
            'number'          => '* ' . trans('fi.quote_number'),
            'group_id'        => trans('fi.group'),
            'expires_at'      => trans('fi.expires'),
            'summary'         => trans('fi.summary'),
            'terms'           => trans('fi.terms_and_conditions'),
        ];
    }

    public function getMapRules()
    {
        return [
            'created_at'      => 'required',
            'company_profile' => 'required',
            'client_name'     => 'required',
            'number'          => 'required',
        ];
    }

    public function getValidator($input)
    {
        return $this->quoteValidator->getRawValidator($input);
    }

    public function importData($input)
    {
        $row             = 1;
        $fields          = [];
        $companyProfiles = CompanyProfile::get();
        $userId          = auth()->user()->id;

        foreach ($input as $field => $key)
        {
            if (is_numeric($key))
            {
                $fields[$key] = $field;
            }
        }

        try
        {
            $handle = fopen(storage_path('quotes.csv'), 'r');
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

                // Create the initial record from the file line
                foreach ($fields as $key => $field)
                {
                    $record[$field] = $data[$key];
                }

                // Replace the client name with the client id
                $client = $this->clientRepository->firstOrCreate($record['client_name']);

                $record['client_id'] = $client->id;

                unset($record['client_name']);

                // Replace the company profile name with the company profile id
                $companyProfile = $companyProfiles->where('name', $record['company_profile'])->first();

                if ($companyProfile)
                {
                    $record['company_profile_id'] = $companyProfile->id;
                }
                else
                {
                    $record['company_profile_id'] = config('fi.defaultCompanyProfile');
                }

                unset($record['company_profile']);

                // Format the created at date
                if (strtotime($record['created_at']))
                {
                    $record['created_at'] = date('Y-m-d', strtotime($record['created_at']));
                }
                else
                {
                    $record['created_at'] = date('Y-m-d');
                }

                // Attempt to format this date if it exists
                // Otherwise generate date based on config setting
                if (isset($record['expires_at']) and strtotime($record['expires_at']))
                {
                    $record['expires_at'] = date('Y-m-d', strtotime($record['expires_at']));
                }
                else
                {
                    $record['expires_at'] = DateFormatter::incrementDateByDays($record['created_at'], config('fi.quotesExpireAfter'));
                }

                // Attempt to convert the invoice group name to an id
                // Otherwise default to default id from config setting
                if (isset($record['group_id']))
                {
                    if (!$record['group_id'] = $this->groupRepository->findIdByName($record['group_id']))
                    {
                        $record['group_id'] = config('fi.quoteGroup');
                    }
                }
                else
                {
                    $record['group_id'] = config('fi.quoteGroup');
                }

                // Assign the quote to the current logged in user
                $record['user_id'] = $userId;

                // Set the status to draft.
                $record['quote_status_id'] = QuoteStatuses::getStatusId('draft');

                // Default the footer
                $record['footer'] = config('fi.quoteFooter');

                // The record *should* validate, but just in case...
                if ($this->validateRecord($record))
                {
                    $this->quoteRepository->create($record, $client, false);
                }
            }
            $row++;
        }

        fclose($handle);

        return true;
    }
}