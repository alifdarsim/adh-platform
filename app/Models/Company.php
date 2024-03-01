<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Post
 * @mixin Builder
 */
class Company extends Model
{
    protected $table = 'companies';
    protected $guarded = [];
    protected $casts = [
        'industry_id' => 'integer',
        'specialties' => 'object',
        'others' => 'array',
        'pic' => 'object',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function type(): HasOne
    {
        return $this->hasOne(CompanyType::class, 'id', 'type_id')->select('id', 'name');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'id', 'company_id');
    }

    public function finance(): HasOne
    {
        return $this->hasOne(Finance::class, 'id', 'finance_id');
    }

    public function teams(): HasMany
    {
        return $this->hasMany(ClientTeam::class, 'company_id', 'id');
    }

    public function industry(): HasOne
    {
        return $this->hasOne(IndustryExpert::class, 'id', 'industry_id');
    }

}
