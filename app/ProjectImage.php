<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = [
    	'project_id', 'image'
    ];

	public function images()
	{
		return $this->belongsTo('App\Project');
	}

}
