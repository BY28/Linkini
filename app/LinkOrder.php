<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LinkOrder extends Model
{
    protected $fillable = [
    	'project_id', 'entreprise_id', 'user_id','accepted', 'refused', 'seen'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
    
    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function entreprise()
    {
    	return $this->belongsTo('App\Entreprise');
    }
}
