<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        return $this->belongsToMany(Country::class, 'project_target_country', 'project_id', 'country_id')->select(['name', 'emoji']);
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
        return $this->hasOne(ProjectShortlist::class, 'project_id', 'id');
    }

    public function invited(): hasMany
    {
        return $this->hasMany(ProjectInvited::class, 'project_id', 'id');
    }

    public function invited_user_accepted()
    {
        return $this->invited()->where('email', auth()->user()->email)->first()->accepted;
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

    public function awardedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'awarded_to', 'id');
    }

    public function contract(): hasMany
    {
        return $this->hasMany(ProjectContract::class, 'project_id', 'id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(ProjectPayment::class, 'project_id', 'id');
    }
}
