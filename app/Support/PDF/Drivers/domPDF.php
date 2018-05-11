<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Support\PDF\Drivers;

use FI\Support\PDF\PDFAbstract;

define('DOMPDF_ENABLE_REMOTE', true);
define('DOMPDF_ENABLE_AUTOLOAD', false);
define('DOMPDF_TEMP_DIR', storage_path('/'));
define('DOMPDF_FONT_DIR', storage_path('/'));
define('DOMPDF_FONT_CACHE', storage_path('/'));
define('DOMPDF_LOG_OUTPUT_FILE', storage_path('/dompdf_log'));
define('DOMPDF_ENABLE_HTML5PARSER', true);
define('DOMPDF_ENABLE_FONTSUBSETTING', true);

require_once base_path('vendor/dompdf/dompdf/dompdf_config.inc.php');

class domPDF extends PDFAbstract
{
    private function getPdf($html)
    {
        $pdf = new \DOMPDF();
        $pdf->set_paper($this->paperSize, $this->paperOrientation);
        $pdf->load_html($html);

        // Suppressing warning PHP 7.1 will output.
        @$pdf->render();

        return $pdf;
    }

    public function getOutput($html)
    {
        $pdf = $this->getPdf($html);

        return $pdf->output();
    }

    public function save($html, $filename)
    {
        file_put_contents($filename, $this->getOutput($html));
    }

    public function download($html, $filename)
    {
        $response = response($this->getOutput($html));

        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

        return $response->send();
    }
}