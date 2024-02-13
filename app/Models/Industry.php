<?php

namespace App\Models;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Industry
 * @mixin Builder
 */
class Industry extends Model
{
    protected $table = 'industry';
    protected $guarded = [];
}
