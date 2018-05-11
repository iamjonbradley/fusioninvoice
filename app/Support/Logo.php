<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Support;

class Logo
{
    public static function getImg($maxWidth = null)
    {
        if (config('fi.logo') and file_exists(storage_path(config('fi.logo'))))
        {
            $logo = base64_encode(file_get_contents(storage_path(config('fi.logo'))));

            $imgHtml = '<img src="data:image/png;base64,' . $logo . '"' . (isset($maxWidth) ? ' style="max-width: ' . $maxWidth . 'px;"' : '') . '>';

            return $imgHtml;
        }

        return null;
    }

    public static function delete()
    {
        if (file_exists(storage_path(config('fi.logo'))))
        {
            unlink(storage_path(config('fi.logo')));
        }
    }

    public static function size($width, $height)
    {
        $logo = base64_encode(file_get_contents(storage_path(config('fi.logo'))));

        return '<img src="data:image/png;base64,' . $logo . '" style="width: ' . $width . 'px; height: ' . $height . 'px;">';
    }
}