<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';

    protected $fillable = [
        'email', 'subject', 'body'
    ];

    use SoftDeletes;
}
