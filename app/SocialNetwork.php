<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    protected $table = 'social_networks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'icon', 'title', 'color', 'url'
    ];
}
