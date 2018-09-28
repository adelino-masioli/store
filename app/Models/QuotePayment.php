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

class QuotePayment extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'quote_payments';
    protected $fillable = [
        'price',
        'quote_id',
        'payment_id'
    ];

    public function quote() {
        return $this->belongsTo('App\Models\Quote', 'quote_id');
    }
    public function payment() {
        return $this->belongsTo('App\Models\Payment', 'payment_id');
    }
    public static function getPaymentValue($quote_id, $payment_id)
    {
        $price =  QuotePayment::where('quote_id', $quote_id)->where('payment_id', $payment_id);
        if($price->count() > 0){
            return money_br($price->first()->price);
        }else{
            return '0.00';
        }
    }
}