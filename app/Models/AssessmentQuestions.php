<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 * @mixin Builder
 */
class AssessmentQuestions extends Model
{
    protected $table = 'assessment_questions';
    protected $guarded = [];

    protected $casts = [
        'options' => 'array'
    ];
}
