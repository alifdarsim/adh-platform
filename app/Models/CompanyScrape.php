<?php

namespace App\Models;

use Eloquent;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 * @mixin Builder
 * @mixin Eloquent
 */
class CompanyScrape extends Model
{
    protected $table = 'scrape_linkedin_company';
    protected $guarded = [];
    protected $casts = [
        'data' => 'array',
    ];
}
