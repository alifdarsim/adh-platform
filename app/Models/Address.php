<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Post
 * @mixin Builder
 */
class Address extends Model
{
    protected $table = 'company_address';

    protected $guarded = [];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'id', 'address_id');
    }
}
