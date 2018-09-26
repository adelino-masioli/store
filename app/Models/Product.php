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
        'status'
    ];

    public static function productByCategory($category_id)
    {
        $categories =  ProductCategory::where('category_id', $category_id)->where('status', 1)->get();

        $productsArray = [];
        foreach ($categories as $category){
            foreach (Product::where('id', $category->product_id)->orderBy('name', 'asc')->get() as $product){
                $productsArray[] = $product;
            }
        }
        return $productsArray;
    }

    public static function productCategory($product_id)
    {
        $category_id =  ProductCategory::where('product_id', $product_id)->first();
        $category =  Category::where('id', $category_id->category_id)->where('status', 1)->first();

        return $category;
    }
}