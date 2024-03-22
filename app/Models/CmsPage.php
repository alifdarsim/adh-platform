<?php

namespace App\Models;

use Carbon\Traits\Mixin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */
class CmsPage extends Model
{
    protected $table = 'cms_post';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $casts = [
        'featured' => 'boolean'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(CmsAuthor::class);
    }
}
