<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'status_id',
        'configuration_id',
        'type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function configuration() {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }

    public function type() {
        return $this->belongsTo('App\Models\UserType', 'type_id');
    }
}
