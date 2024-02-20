<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Post
 * @mixin Builder
 */
class ProjectShortlist extends Model
{
    protected $table = 'project_shortlisted';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'token'];
    protected $casts = [
        'invited' => 'boolean',
        'accepted' => 'boolean',
    ];

    public function expert(): BelongsTo
    {
        return $this->belongsTo(ExpertList::class, 'expert_id', 'id');
    }

    public function expert_email(): BelongsTo
    {
        return $this->belongsTo(ExpertList::class)->select('id', 'email');
    }

    public function invitation(): BelongsTo
    {
        return $this->belongsTo(ProjectInvited::class, 'project_id', 'project_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }

}
