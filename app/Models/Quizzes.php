<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quizzes extends Model
{
    use SoftDeletes;
    protected $table = 'course_quizzes';

    protected $guarded = [];

    public $timestamps = true;

    public function quizPrerequisites(): HasMany
    {
        return $this->hasMany(QuizPrerequisites::class, 'quiz_id', 'id');
    }

    public function quizQuestions():HasMany{
        return $this->hasMany(QuizQuestions::class, 'quiz_id', 'id');
    }
}
