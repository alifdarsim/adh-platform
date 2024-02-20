<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 * @mixin Builder
 */
class PasswordReset extends Model
{
    protected $table = 'password_reset_tokens';
    protected $guarded = [];
}
