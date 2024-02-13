<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Post
 * @mixin Builder
 */
class ProjectExpert extends Model
{
    protected $table = 'project_expert';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'token'];
    protected $casts = [
        'invited' => 'boolean',
        'accepted' => 'boolean',
    ];

    public function expert(): BelongsTo
    {
        return $this->belongsTo(Expert::class, 'expert_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }

}
