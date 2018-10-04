<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderTimeline extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'order_timelines';
    protected $fillable = [
        'user_name',
        'customer_name',
        'description',
        'order_id',
        'user_id',
        'customer_id',
        'configuration_id',
        'status_id'
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function customer() {
        return $this->belongsTo('App\User', 'customer_id');
    }
    public function configuration() {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }
    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
}
