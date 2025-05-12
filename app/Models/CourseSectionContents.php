<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseSectionContents extends Model
{
    protected $table = 'course_section_contents';

    protected $guarded = [];

    public $timestamps = true;

    public function links(): HasMany
    {
        return $this->hasMany(ContentLinks::class, 'course_section_content_id', 'id');
    }
}
