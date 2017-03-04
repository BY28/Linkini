<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
    	'user_id', 'entreprise_id'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }


    public function entreprise()
    {
        return $this->belongsTo('App\Entreprise');
    }
}