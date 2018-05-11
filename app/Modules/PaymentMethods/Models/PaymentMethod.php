<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\PaymentMethods\Models;

use FI\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use Sortable;

    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

    protected $sortable = ['name'];
}