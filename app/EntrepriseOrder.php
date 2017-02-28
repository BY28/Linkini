<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntrepriseOrder extends Model
{
    protected $fillable = [
        'user_id', 'name', 'description'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
