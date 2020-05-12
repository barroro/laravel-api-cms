<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkSectionImages extends Model
{
    protected $table = 'work_section_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'work_section_id', 'image_id'
    ];
}
