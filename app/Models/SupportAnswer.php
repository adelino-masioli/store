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

class SupportAnswer extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'support_answers';
    protected $fillable = [
        'name',
        'description',
        'file',
        'extension',
        'size',
        'click',
        'support_id',
        'user_id'
    ];

    public function support() {
        return $this->belongsTo('App\Models\Support', 'support_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}