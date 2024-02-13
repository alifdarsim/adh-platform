<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * ProjectAnswer
 * @mixin Builder
 */
class ProjectAnswer extends Model
{
    protected $table = 'project_answer';
    protected $guarded = [];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'answers' => 'array',
    ];
}
