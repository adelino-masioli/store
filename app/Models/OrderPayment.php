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

class OrderPayment extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'order_payments';
    protected $fillable = [
        'price',
        'order_id',
        'payment_id'
    ];

    public function order() {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
    public function payment() {
        return $this->belongsTo('App\Models\Payment', 'payment_id');
    }
    public static function getPaymentValue($order_id, $payment_id)
    {
        $price =  OrderPayment::where('order_id', $order_id)->where('payment_id', $payment_id);
        if($price->count() > 0){
            return money_br($price->first()->price);
        }else{
            return '';
        }
    }
}