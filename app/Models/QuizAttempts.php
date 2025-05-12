<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempts extends Model
{
    protected $table = 'quiz_attempts';

    protected $guarded = [];

    public $timestamps = true;
}
