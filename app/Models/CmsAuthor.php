<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Post
 * @mixin Builder
 */
class CmsAuthor extends Model
{
    protected $table = 'cms_author';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'status',
        'position',
        'company',
        'created_at',
        'updated_at',
    ];



    public function posts()
    {
        return $this->hasMany(CmsPage::class, 'author_id');
    }
}
