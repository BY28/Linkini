<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
     protected $fillable = [
        'user_id', 'category_id','title', 'content'
    ];

     public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function links()
    {
        return $this->hasMany('App\Link');
    }

    public function linkorder()
    {
        return $this->hasOne('App\LinkOrder');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
