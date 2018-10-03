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

class Support extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'supports';
    protected $fillable = [
        'name',
        'title',
        'description',
        'file',
        'extension',
        'size',
        'click',
        'status_id',
        'configuration_id',
        'user_id',
    ];

    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    public function type() {
        return $this->belongsTo('App\Models\DocumentType', 'type_id');
    }
    public function configuration() {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}