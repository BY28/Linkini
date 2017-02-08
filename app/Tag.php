<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
    	'tag', 'tag_url'
    ];

	public function projects()
	{
		return $this->belongsToMany('App\Project');
	}

	public function entreprises()
	{
		return $this->belongsToMany('App\Entreprise');
	}  
}
