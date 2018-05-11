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

use FI\Events\QuoteModified;
use FI\Modules\Quotes\Models\Quote;
use FI\Modules\Quotes\Repositories\QuoteItemRepository;
use FI\Modules\Quotes\Repositories\QuoteRepository;
use FI\Modules\TaxRates\Models\TaxRate;
use Illuminate\Support\Facades\Validator;

class QuoteItemImporter extends AbstractImporter
{
    private $quoteItemRepository;
    private $quoteRepository;

    public function __construct(
        QuoteItemRepository $quoteItemRepository,
        QuoteRepository $quoteRepository
    )
    {
        parent::__construct();
        $this->quoteItemRepository = $quoteItemRepository;
        $this->quoteRepository     = $quoteRepository;
    }

    public function getFields()
    {
        return [
            'quote_id'      => '* ' . trans('fi.quote_number'),
            'name'          => '* ' . trans('fi.product'),
            'quantity'      => '* ' . trans('fi.quantity'),
            'price'         => '* ' . trans('fi.price'),
            'description'   => trans('fi.description'),
            'tax_rate_id'   => trans('fi.tax_1'),
            'tax_rate_2_id' => trans('fi.tax_2'),
        ];
    }

    public function getMapRules()
    {
        return [
            'quote_id' => 'required',
            'name'     => 'required',
            'quantity' => 'required',
            'price'    => 'required',
        ];
    }

    public function getValidator($input)
    {
        return Validator::make($input, [
                'quote_id' => 'required',
                'name'     => 'required',
                'quantity' => 'required|numeric',
                'price'    => 'required|numeric',
            ]
        );
    }

    public function importData($input)
    {
        $row = 1;

        $fields = [];

        $taxRates = TaxRate::get();

        foreach ($input as $field => $key)
        {
            if (is_numeric($key))
            {
                $fields[$key] = $field;
            }
        }

        try
        {
            $handle = fopen(storage_path('quoteItems.csv'), 'r');
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

                foreach ($fields as $key => $field)
                {
                    $record[$field] = $data[$key];
                }

                $quote = Quote::where('number', $record['quote_id'])->first();

                if ($quote)
                {
                    $record['quote_id'] = $this->quoteRepository->findIdByNumber($record['quote_id']);

                    if (!isset($record['tax_rate_id']))
                    {
                        $record['tax_rate_id'] = 0;
                    }
                    else
                    {
                        if ($taxRate = $taxRates->where('name', $record['tax_rate_id'])->first())
                        {
                            $record['tax_rate_id'] = $taxRate->id;
                        }
                        else
                        {
                            $record['tax_rate_id'] = 0;
                        }
                    }

                    if (!isset($record['tax_rate_2_id']))
                    {
                        $record['tax_rate_2_id'] = 0;
                    }
                    else
                    {
                        if ($taxRate = $taxRates->where('name', $record['tax_rate_2_id'])->first())
                        {
                            $record['tax_rate_2_id'] = $taxRate->id;
                        }
                        else
                        {
                            $record['tax_rate_2_id'] = 0;
                        }
                    }

                    $record['display_order'] = 0;

                    if ($this->validateRecord($record))
                    {
                        if (!isset($record['description'])) $record['description'] = '';

                        $this->quoteItemRepository->create($record);

                        event(new QuoteModified($quote));
                    }
                }
            }

            $row++;
        }

        fclose($handle);

        return true;
    }
}