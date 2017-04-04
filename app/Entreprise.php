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
        'user_id', 'activity_id', 'category_id','name', 'email','phone', 'address','image', 'description', 'entreprise_url'
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

    public function linkorders()
    {
        return $this->hasMany('App\LinkOrder');
    }

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function page()
    {
        return $this->hasOne('App\LinkiniPage');
    }

}
