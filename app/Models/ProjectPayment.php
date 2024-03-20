<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    protected $table = 'project_payment';
    protected $guarded = [];
    protected $casts = [
        'payment_info' => 'array',
    ];
}
