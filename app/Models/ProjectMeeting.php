<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 * @mixin Builder
 */
class ProjectMeeting extends Model
{
    protected $table = 'project_meetings';

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
