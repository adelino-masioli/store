<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderAnnotation extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'order_annotations';
    protected $fillable = [
        'user_name',
        'description',
        'color',
        'order_id',
        'user_id',
        'status_id'
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
}
