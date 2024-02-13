<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * Expert
 * @mixin Builder
 */
class Expert extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $table = 'experts';
    protected $guarded = [];
    protected $casts = [
        'skills' => 'array',
        'languages' => 'array',
        'experiences' => 'array',
        'educations' => 'array',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'expert_id', 'id');
    }

    public function assessment(): HasOne
    {
        return $this->hasOne(Assessment::class, 'user_id', 'id');
    }

    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(Projects::class, ProjectExpert::class, 'expert_id', 'id', 'id', 'project_id');
    }

}
