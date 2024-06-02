<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravolt\Avatar\Facade as Avatar;

/**
 * Post
 * @mixin Builder
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, AuthenticationLoggable, LogsActivity, InteractsWithMedia;

    protected array $guard_name = ['sanctum', 'web'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'phone',
        'phone_code',
        'referer_code',
        'referer_id',
        'role',
        'token',
        'timezone',
        'token_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'expert_onboarding' => 'boolean',
        'client_onboarding' => 'boolean',
        'payment_info' => 'array',
    ];

    /**
     * Register media collections.
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 100, 100);
    }

    /**
     * The attributes that should be logged.
     * @return LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }

    public function user_avatar($name = null): string | \Laravolt\Avatar\Avatar | null
    {
        if ($name == null) {
            $avatar_path = auth()->user()->avatar_path;
            if ($avatar_path != null) return $avatar_path;
            if (auth()->user()->expert != null) return auth()->user()->expert->img_url == null ? Avatar::create(auth()->user()->name)->toBase64() : auth()->user()->expert->img_url;
            else return Avatar::create($this->name)->toBase64();
        }
        if ($this->avatar_path != null) return $this->avatar_path;
        if ($this->expert != null) return $this->expert->img_url == null ? Avatar::create($name)->toBase64() : $this->expert->img_url;
        else return Avatar::create($name)->toBase64();
    }

    public function expert(): HasOne
    {
        return $this->hasOne(ExpertList::class, 'email', 'email');
    }

    public function country(): HasOne
    {
        return $this->hasOne(Country::class);
    }

    public function company(): HasMany
    {
        return $this->hasMany(Company::class, 'created_by')->select('name', 'id');
    }

    public function assessment(): HasOne
    {
        return $this->hasOne(Assessment::class, 'user_id', 'id');
    }

    public function client(): HasOne
    {
        Client::where('user_id', auth()->id())->firstOrCreate(['user_id' => auth()->id()]);
        return $this->hasOne(Client::class, 'user_id', 'id');
    }

    public function payment(): HasMany
    {
        return $this->hasMany(PaymentExpert::class, 'expert_id', 'id');
    }

    public function isAdmin(): bool
    {
        return $this->role == 'admin';
    }

    public function isMember(): bool
    {
        return $this->role == 'member';
    }

}
