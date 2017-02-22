<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class Message extends Model
{
    protected $fillable = [
    	'sender_id', 'receiver_id', 'subject', 'message', 'read'
    ];

    protected $append = ['sender', 'receiver'];

    public function getSenderAttribute()
    {
    	return User::where('id', $this->sender_id)->first();
    }
    
    public function getReceiverAttribute()
    {
    	return User::where('id', $this->receiver_id)->first();
    }

    public function getCreatedAtAttribute($value)
    {
    	return Carbon::parse($value)->diffForHumans();
    }

}
