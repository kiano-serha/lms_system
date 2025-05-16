<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class QuizQuestions extends Model
{
    protected $table = 'quiz_questions';

    protected $guarded = [];

    public $timestamps = true;

    public function questionAnswers(): HasMany
    {
        return $this->hasMany(QuestionAnswers::class, 'question_id', 'id');
    }

    public function correctAnswer(): HasOne
    {
        return $this->hasOne(QuestionAnswers::class, 'question_id', 'id')->where('correct', 1);
    }
}
