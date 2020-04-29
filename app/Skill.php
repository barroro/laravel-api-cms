<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'description', 'percentage', 'icon'
    ];
}
