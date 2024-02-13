<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Finance
 * @mixin Builder
 */
class Finance extends Model
{

        protected $table = 'company_finance';

        protected $guarded = [];

        public function company(): BelongsTo
        {
            return $this->belongsTo(Company::class);
        }
}
