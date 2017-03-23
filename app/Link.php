<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Link extends Model
{
    protected $fillable = [
    	'project_id', 'entreprise_id', 'user_id', 'amount', 'time', 'informations', 'accepted', 'refused', 'confirmed'
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
