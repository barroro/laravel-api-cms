<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkImage extends Model
{
    protected $table = 'work_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'work_id', 'image_id'
    ];
}
