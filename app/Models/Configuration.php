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
        'theme',
        'url',
        'url_security',
        'name',
        'nickname',
        'contact',
        'email',
        'phone',
        'whatsapp',
        'summary',
        'about',
        'zipcode',
        'address',
        'district',
        'number',
        'state',
        'city',
        'brand',
        'status_id',
        'theme_id',
    ];

    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function theme() {
        return $this->belongsTo('App\Models\Theme', 'theme_id');
    }
}