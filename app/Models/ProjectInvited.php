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
class ProjectInvited extends Model
{
    protected $table = 'project_invited';
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'token'];
    protected $casts = [
        'invited' => 'boolean',
        'accepted' => 'boolean',
    ];

    public function expert(): BelongsTo
    {
        return $this->belongsTo(ExpertList::class, 'email', 'email');
    }

    public function expert_email(): BelongsTo
    {
        return $this->belongsTo(ExpertList::class, 'email', 'email')->select('id', 'email');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
