<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizPrerequisites extends Model
{
    use SoftDeletes;
    protected $table = 'quiz_prerequisites';

    protected $guarded = [];

    public $timestamps = true;

    public function section(): HasOne
    {
        return $this->hasOne(CourseSections::class, 'id', 'section_id');
    }
}
