<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Message;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password' , 'first_name', 'last_name', 'address', 'phone', 'informations', 'image', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    /*public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }*/

    public function entreprise()
    {
        return $this->hasOne('App\Entreprise');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function order()
    {
        return $this->hasOne('App\EntrepriseOrder');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    public function favorites()
    {
        return $this->hasMany('App\Favorite');
    }

    public function getUnreadMessagesNum()
    {
        return Message::where('receiver_id', $this->id)->where('read', false)->count();
    }
}
