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

class Configuration extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'configurations';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp',
        'about',
        'address',
        'district',
        'state', 2,
        'city'
    ];
}