<?php

namespace App\Models;

use App\Http\Controllers\ProjectInvitationController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class UserExpert extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'user_expert';
    protected $guarded = [];
    protected $casts = [
        'skills' => 'array',
        'languages' => 'array',
        'experiences' => 'array',
        'educations' => 'array',
    ];

    public function industry(): HasOne
    {
        return $this->hasOne(IndustryExpert::class, 'id', 'industry_id');
    }

}
