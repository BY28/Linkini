<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntrepriseOrder extends Model
{
    protected $fillable = [
        'user_id', 'activity_id', 'category_id','name', 'email', 'phone', 'address', 'description'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function activity()
    {
    	return $this->belongsTo('App\Activity');
    }

        public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
