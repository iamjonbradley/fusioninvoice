<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Widgets\Dashboard\ClientActivity\Repositories;

use FI\Modules\Activity\Models\Activity;

class ClientActivityWidgetRepository
{
    public function getRecentClientActivity()
    {
        return Activity::where('activity', 'like', 'public%')
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();
    }
}