<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    protected $fillable = [
    	'user_id', 'project_id', 'title', 'content', 'seen'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}