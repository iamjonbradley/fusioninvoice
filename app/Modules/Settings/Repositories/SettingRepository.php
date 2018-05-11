<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Settings\Repositories;

use FI\Modules\Settings\Models\Setting;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use PDOException;

class SettingRepository
{
    public function setAll()
    {
        try
        {
            $settings = Setting::all();

            foreach ($settings as $setting)
            {
                config(['fi.' . $setting->setting_key => $setting->setting_value]);
            }

            return true;
        }
        catch (QueryException $e)
        {
            return false;
        }
        catch (PDOException $e)
        {
            return false;
        }
    }

    public function get($key)
    {
        return Setting::where('setting_key', $key)->first()->setting_value;
    }

    public function save($key, $value)
    {
        $setting = Setting::firstOrNew(['setting_key' => $key]);

        $setting->setting_value = $value;

        $setting->save();

        config(['fi.' . $key => $value]);
    }

    public function writeEmailTemplates()
    {
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

        foreach ($emailTemplates as $template)
        {
            $templateContents = $this->get($template);
            $templateContents = str_replace('{{', '{!!', $templateContents);
            $templateContents = str_replace('}}', '!!}', $templateContents);

            Storage::put('email_templates/' . $template . '.blade.php', $templateContents);
        }
    }

    public function delete($key)
    {
        Setting::where('setting_key', $key)->delete();
    }
}