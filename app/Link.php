<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
    	'project_id', 'entreprise_id', 'user_id','accepted', 'refused', 'seen'
    ];

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function entreprise()
    {
    	return $this->belongsTo('App\Entreprise');
    }
}
