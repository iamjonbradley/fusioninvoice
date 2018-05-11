<?php

use Illuminate\Database\Migrations\Migration;

class EmailSubjectSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settingRepository = App::make('FI\Modules\Settings\Repositories\SettingRepository');

        $settingRepository->save('quoteEmailSubject', 'Quote #{{ $quote->number }}');
        $settingRepository->save('invoiceEmailSubject', 'Invoice #{{ $invoice->number }}');
        $settingRepository->save('overdueInvoiceEmailSubject', 'Overdue Invoice Reminder: Invoice #{{ $invoice->number }}');
        $settingRepository->save('upcomingPaymentNoticeEmailSubject', 'Upcoming Payment Due Notice: Invoice #{{ $invoice->number }}');
        $settingRepository->save('paymentReceiptEmailSubject', 'Payment Receipt for Invoice #{{ $payment->invoice->number }}');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
