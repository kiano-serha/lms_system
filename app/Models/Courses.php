<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Courses extends Model
{
    use SoftDeletes;
    protected $table = 'courses';

    protected $guarded = [];

    public $timestamps = true;

    public function category(): HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }


    public function courseSections(): HasMany
    {
        return $this->hasMany(CourseSections::class, 'course_id', 'id');
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quizzes::class, 'course_id', 'id');
    }

    public function courseUsers(): HasMany
    {
        return $this->hasMany(CourseUsers::class, 'course_id', 'id');
    }

    public function targetAudience():HasOne{
        return $this->hasOne(TargetAudience::class, 'course_id', 'id');
    }

    public function learningOutcome():HasOne{
        return $this->hasOne(LearningOutcomes::class, 'course_id', 'id');
    }
}
