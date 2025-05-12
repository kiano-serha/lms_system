<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseSections extends Model
{
    protected $table = 'course_sections';

    protected $guarded = [];

    public $timestamps = true;

    public function contents(): HasMany
    {
        return $this->hasMany(CourseSectionContents::class, 'course_section_id', 'id');
    }
}
