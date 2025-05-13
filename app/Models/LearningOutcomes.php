<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningOutcomes extends Model
{
    protected $table = 'course_learning_outcomes';

    protected $guarded = [];

    public $timestamps = true;
}
