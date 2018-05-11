<?php

use Illuminate\Database\Migrations\Migration;

class UpgradeEmailTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $settingRepository = app('FI\Modules\Settings\Repositories\SettingRepository');

        $emailTemplates = [
            'invoiceEmailBody',
            'quoteEmailBody',
            'overdueInvoiceEmailBody',
            'upcomingPaymentNoticeEmailBody',
            'quoteApprovedEmailBody',
            'quoteRejectedEmailBody',
            'paymentReceiptBody',
            'quoteEmailSubject',
            'invoiceEmailSubject',
            'overdueInvoiceEmailSubject',
            'upcomingPaymentNoticeEmailSubject',
            'paymentReceiptEmailSubject',
        ];

        $findReplace = [
            'user->company'           => 'companyProfile->company',
            'user->formatted_address' => 'companyProfile->formatted_address',
            'user->phone'             => 'companyProfile->phone',
            'user->fax'               => 'companyProfile->fax',
            'user->mobile'            => 'companyProfile->mobile',
            'user->web'               => 'companyProfile->web',
            'user->address'           => 'companyProfile->address',
            'user->city'              => 'companyProfile->city',
            'user->state'             => 'companyProfile->state',
            'user->zip'               => 'companyProfile->zip',
            'user->country'           => 'companyProfile->country',
        ];

        foreach ($emailTemplates as $emailTemplate)
        {
            $template = $settingRepository->get($emailTemplate);

            foreach ($findReplace as $find => $replace)
            {
                $template = str_replace($find, $replace, $template);
            }

            $settingRepository->save($emailTemplate, $template);
        }

        $settingRepository->writeEmailTemplates();
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
