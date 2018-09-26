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
        'zipcode',
        'address',
        'district',
        'number',
        'state',
        'city',
        'phone',
        'cellphone',
        'status_id'
    ];
}