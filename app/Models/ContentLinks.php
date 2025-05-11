<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentLinks extends Model
{
    use SoftDeletes;

    protected $table = 'content_links';

    protected $guarded = [];

    public $timestamps = true;
}
