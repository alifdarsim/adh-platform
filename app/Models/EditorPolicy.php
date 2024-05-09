<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 * @mixin Builder
 */
class EditorPolicy extends Model
{
    protected $table = 'policy_editor';
    protected $guarded = [];
}
