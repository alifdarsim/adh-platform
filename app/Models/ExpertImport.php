<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 * @mixin Builder
 */
class ExpertImport extends Model
{
    protected $table = 'expert_imports';
    protected $guarded = [];
    protected $casts = [
        'result' => 'array',
    ];
}
