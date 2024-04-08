<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Post
 * @mixin Builder
 */
class ProjectExpert extends Model
{
    protected $table = 'project_expert';
    protected $guarded = [];
    protected $casts = [
        'invited' => 'boolean',
        'accepted' => 'boolean',
    ];

    public function expert(): BelongsTo
    {
        return $this->belongsTo(ExpertList::class, 'expert_id', 'id');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(PaymentExpert::class, 'project_expert_id', 'id');
    }

    public function contract(): HasMany
    {
        return $this->hasMany(ContractExpert::class, 'project_expert_id', 'id');
    }

    public function expert_email(): BelongsTo
    {
        return $this->belongsTo(ExpertList::class)->select('id', 'email');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }

}
