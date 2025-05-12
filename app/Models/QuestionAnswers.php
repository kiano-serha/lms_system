<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswers extends Model
{
    protected $table = 'question_answers';

    protected $guarded = [];

    public $timestamps = true;
}
