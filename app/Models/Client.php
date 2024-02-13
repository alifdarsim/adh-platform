<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Post
 * @mixin Builder
 */
class Client extends Model
{
    use LogsActivity;

    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'website', 'type', 'establish', 'overview', 'contact', 'email', 'status', 'registered_by'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->useLogName('Company')->logFillable()->logOnlyDirty();
    }

    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function city(): HasOne
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function finance(): HasOne
    {
        return $this->hasOne(Finance::class);
    }

}
