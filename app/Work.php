<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'works';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'subtitle', 'content', 'image'
    ];

    public function sections()
    {
        return $this->hasMany('App\WorkSection');
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Image', 'work_images');
    }
}
