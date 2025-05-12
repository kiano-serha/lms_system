<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseUsers extends Model
{
    protected $table = 'course_users';

    protected $guarded = [];

    public $timestamps = true;
}
