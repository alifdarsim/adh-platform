<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentClient extends Model
{
    protected $table = 'payment_client';
    protected $guarded = [];
    protected $casts = [
        'info' => 'object'
    ];

    public function projects(): BelongsTo
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
