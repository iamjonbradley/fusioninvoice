<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\ClientCenter\Controllers;

use FI\Events\InvoiceViewed;
use FI\Http\Controllers\Controller;
use FI\Modules\Invoices\Repositories\InvoiceRepository;
use FI\Modules\Merchant\Support\MerchantProperties;
use FI\Support\FileNames;
use FI\Support\PDF\PDFFactory;
use FI\Support\Statuses\InvoiceStatuses;

class ClientCenterPublicInvoiceController extends Controller
{
    private $invoiceRepository;

    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    public function show($urlKey)
    {
        $invoice = $this->invoiceRepository->findByUrlKey($urlKey);

        app()->setLocale($invoice->client->language);

        event(new InvoiceViewed($invoice));

        return view('client_center.invoices.public')
            ->with('invoice', $invoice)
            ->with('statuses', InvoiceStatuses::statuses())
            ->with('urlKey', $urlKey)
            ->with('merchants', MerchantProperties::setProperties(config('fi.merchant')))
            ->with('attachments', $invoice->clientAttachments);
    }

    public function pdf($urlKey)
    {
        $invoice = $this->invoiceRepository->findByUrlKey($urlKey);

        event(new InvoiceViewed($invoice));

        $pdf = PDFFactory::create();

        $pdf->download($invoice->html, FileNames::invoice($invoice));
    }

    public function html($urlKey)
    {
        $invoice = $this->invoiceRepository->findByUrlKey($urlKey);

        return $invoice->html;
    }
}