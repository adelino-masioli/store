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

class ProductImage extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'product_images';
    protected $fillable = [
        'product_id',
        'name',
        'image',
        'is_cover',
        'status_id'
    ];

    public static function getCoverImage($product_id)
    {
        $image =  ProductImage::where('product_id', $product_id)->where('is_cover', 1)->first();
        if($image){
            return $image->image;
        }
    }
    public static function getImages($product_id)
    {
        $image =  ProductImage::where('product_id', $product_id)->get();
        return $image;
    }
}