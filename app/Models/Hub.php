<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Post
 * @mixin Builder
 */
class Hub extends Model
{

    protected $table = 'hub_type';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
