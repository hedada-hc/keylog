<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keylog extends Model
{
    protected $fillable = [
    	'referer','keyword','region','ip','tag','user_agent'
    ];
}
