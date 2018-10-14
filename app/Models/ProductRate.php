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

class ProductRate extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'product_ratings';
    protected $fillable = [
        'rate',
        'product_id',
        'user_id'
    ];

    public function product() {
        return $this->hasOne('App\Models\Product', 'product_id');
    }
}