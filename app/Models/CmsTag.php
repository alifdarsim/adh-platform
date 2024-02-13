<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 *
 * @mixin Builder
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static Builder|CmsTag newModelQuery()
 * @method static Builder|CmsTag newQuery()
 * @method static Builder|CmsTag query()
 * @method static Builder|CmsTag whereCreatedAt($value)
 * @method static Builder|CmsTag whereId($value)
 * @method static Builder|CmsTag whereName($value)
 * @method static Builder|CmsTag whereStatus($value)
 * @method static Builder|CmsTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CmsTag extends Model
{
    protected $table = 'cms_tag';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at',
    ];
}
