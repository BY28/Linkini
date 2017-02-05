<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
     protected $fillable = [
        'user_id', 'title', 'content'
    ];

     public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }  
}
