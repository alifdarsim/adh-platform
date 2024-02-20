<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Industry
 * @mixin Builder
 */
class IndustryExpert extends Model
{
    protected $table = 'industry_expert';
    protected $guarded = [];
    protected $casts = [
        'sub' => 'string'
    ];
}
