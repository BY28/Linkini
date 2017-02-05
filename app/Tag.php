<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
    	'tag', 'tag_url'
    ];

	public function demands()
	{
		return $this->belongsToMany('App\Demand');
	}

	public function entreprises()
	{
		return $this->belongsToMany('App\Entreprise');
	}  
}
