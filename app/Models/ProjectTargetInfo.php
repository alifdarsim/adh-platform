<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProjectTargetInfo extends Model
{
    protected $table = 'project_target_info';
    protected $guarded = [];
    protected $casts = [
        'communication_language' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function industry(): Model|HasOne
    {
        return $this->hasOne(Industry::class, 'id', 'industry_id');
    }

}
