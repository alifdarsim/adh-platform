<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Post
 * @mixin Builder
 */
class Client extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'id';
    protected $guarded = [];

    //if user dont have client id, then create one
//    public static function boot(): void
//    {
//        Client::where('user_id', auth()->id())->firstOrCreate(['id' => auth()->id()]);
//    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Projects::class, 'company_id', 'company_id')
            ->with('createdBy')
            ->with('hub')
            ->with('company');
    }

}
