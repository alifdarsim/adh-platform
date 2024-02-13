<?php

namespace App\Models;

use Eloquent;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Post
 *
 * @mixin Builder
 * @mixin Eloquent
 */
class CompanyType extends Model
{

        protected $table = 'company_type';

        protected $guarded = [];

        public function companies(): HasMany
        {
            return $this->hasMany(Client::class, 'type', 'id');
        }
}
