<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 * @mixin Builder
 */
class ExpertLinkedInQueue extends Model
{
    protected $table = 'expert_linkedin_queue';
    protected $guarded = [];
    protected $casts = [
        'result' => 'object',
    ];
}
