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

class Order extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'orders';
    protected $fillable = [
        'origin',
        'type',
        'name',
        'email',
        'phone',
        'about',
        'description',
        'total',
        'discount',
        'zipcode',
        'address',
        'district',
        'number',
        'state',
        'city',
        'status_id',
        'configuration_id',
        'user_id',
        'customer_id',
    ];

    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    public function configuration() {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function customer() {
        return $this->belongsTo('App\User', 'customer_id');
    }
    public function getTotalAttribute($value)
    {
        return money_br($value);
    }
    public function getCreatedAtAttribute($value)
    {
        return date_br($value);
    }
}