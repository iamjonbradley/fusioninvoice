<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Credentials\Models;

use FI\Support\DateFormatter;
use Illuminate\Database\Eloquent\Model;
use FI\Traits\Sortable;

class Credential extends Model
{
    use Sortable;

    protected $table = 'credentials';

    protected $guarded = ['id'];

    protected $sortable = ['client_id', 'credeitial_type', 'name'];

    /**
     * Multiple methods will use this.
     *
     * @return Credential
     */
    protected function getQuery()
    {
        return Credential::select('credentials.*');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo('FI\Modules\Users\Models\User');
    }

    public function user()
    {
        return $this->belongsTo('FI\Modules\Users\Models\User');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedCreatedAtAttribute()
    {
        return DateFormatter::format($this->created_at, true);
    }

    public function getFormattedCredentialAttribute()
    {
        return nl2br($this->credential);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeProtect($query, $user)
    {
        if ($user->client_id)
        {
            return $query->where('private', 0);
        }

    }
}