<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
