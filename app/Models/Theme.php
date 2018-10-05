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

class Theme extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'themes';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'status_id'
    ];

    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
}