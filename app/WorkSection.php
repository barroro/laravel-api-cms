<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkSection extends Model
{
    protected $table = 'work_sections';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'subtitle', 'content'
    ];

    public function work()
    {
        return $this->belongsTo('App\Work', 'work_id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image', 'work_section_images');
    }
}
