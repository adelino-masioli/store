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

class ContactEmail extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'contact_emails';
    protected $fillable = [
        'email',
        'contact_id'
    ];

    public function contact() {
        return $this->belongsTo('App\Models\Contact', 'contact_id');
    }
}