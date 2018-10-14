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

class Product extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'products';
    protected $fillable = [
        'sku',
        'name',
        'description',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'slug',
        'price',
        'qty',
        'weight',
        'height',
        'width',
        'length',
        'packing',
        'status_id',
        'configuration_id',
    ];

    public function rate() {
        return $this->hasMany('App\Models\ProductRate', 'product_id');
    }

    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }

    public function configuration() {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }
}