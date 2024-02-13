<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Post
 * @mixin Builder
 */
class Keyword extends Model
{
    protected $table = 'keywords';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Projects::class, 'project_id', 'id');
    }
}
