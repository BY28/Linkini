<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'image', 'description'
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
