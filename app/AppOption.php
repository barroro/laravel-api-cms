<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppOption extends Model
{
    protected $table = 'app_options';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'value', 'description'
    ];
}
