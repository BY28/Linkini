<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = [
    	'project_id', 'image'
    ];

	public function project()
	{
		return $this->belongsTo('App\Project');
	}

}
