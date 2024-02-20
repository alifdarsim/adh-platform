<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\Permission\Traits\HasRoles;
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
    use HasApiTokens, HasFactory, Notifiable, HasRoles, AuthenticationLoggable, LogsActivity, InteractsWithMedia;

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
        'role',
        'token',
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

    /**
     * Get avatar of the user.
     */
    public function avatar($type = null): string | \Laravolt\Avatar\Avatar | null
    {
        $linkedin_avatar = auth()->user()->expert;
        if ($linkedin_avatar != null) {
            return $linkedin_avatar->img_url == null ? Avatar::create(auth()->user()->name ?? 'NA')->setDimension(150) : $linkedin_avatar->img_url;
        }
        $profile_image = auth()->user()->getMedia('profile_images');
        if ($profile_image->count() > 0) {
            return $type == null ? $profile_image->last()->getUrl() : $profile_image->last()->getUrl('thumb');
        }
        else if (auth()->user()->linkedin_avatar != null) {
            return auth()->user()->linkedin_avatar;
        }
        return Avatar::create(auth()->user()->name ?? 'NA')->setDimension(150);
    }

    public function user_avatar(): string | \Laravolt\Avatar\Avatar | null
    {
        return $this->expert->img_url == null ? Avatar::create($this->name ?? 'NA')->setDimension(150) : $this->expert->img_url;
    }

    public function expert(): HasOne
    {
        $exist = UserExpert::where('user_id', $this->id)->first();
        if ($exist == null) {
            UserExpert::create(['user_id' => $this->id,]);
        }
        return $this->hasOne(UserExpert::class, 'user_id', 'id');
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

    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(Projects::class,ProjectInvited::class, 'email', 'id', 'email', 'project_id');
    }

}
