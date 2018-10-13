<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/15/2018
 * Time: 18:36
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserComplement extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user_complements';
    protected $fillable = [
        'company',
        'zipcode',
        'address',
        'district',
        'number',
        'state',
        'city',
        'phone',
        'cellphone',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}