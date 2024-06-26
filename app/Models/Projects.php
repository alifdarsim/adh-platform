<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Post
 * @mixin Builder
 */
class Projects extends Model
{
    use LogsActivity;

    protected $table = 'projects';
    protected $guarded = [];
    protected $casts = [
        'public' => 'boolean',
        'questions' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deadline' => 'datetime:Y-m-d H:i:s',
        'published_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $hidden = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }

    public function targetCountries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'project_target_country', 'project_id', 'country_id');
    }

    public function projectTargetInfo(): Model|HasOne
    {
        return $this->hasOne(ProjectTargetInfo::class, 'project_id', 'id');
    }

    public function hub(): Model|HasOne
    {
        return $this->hasOne(Hub::class, 'id', 'hub_id');
    }

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class, 'project_keyword', 'project_id', 'keyword_id');
    }

    public function invitedExperts(): BelongsToMany
    {
        return $this->belongsToMany(ExpertList::class, 'project_invitation', 'project_id', 'expert_id');
    }

    public function answered(): object|null
    {
        return ProjectAnswer::where('project_id', $this->id)->where('user_id', auth()->user()->id)->first();
    }

    public function answer(): hasMany
    {
        return $this->hasMany(ProjectAnswer::class, 'project_id', 'id');
    }

    // after this is new one
    public function shortlist(): hasOne
    {
        return $this->hasOne(ProjectExpert::class, 'project_id', 'id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function handleBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handle_by', 'id');
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function award(): hasMany
    {
        return $this->hasMany(ProjectAwarded::class, 'project_id', 'id');
    }

}
