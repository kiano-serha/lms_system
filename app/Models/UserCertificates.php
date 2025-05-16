<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserCertificates extends Model
{
    protected $table = 'user_certificates';

    protected $guarded = [];

    public $timestamps = true;

    public function course(): HasOne
    {
        return $this->hasOne(Courses::class, 'id', 'course_id');
    }
}
