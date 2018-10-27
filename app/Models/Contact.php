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

class Contact extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'contacts';
    protected $fillable = [
        'name',
        'origin',
        'message',
        'status_id',
        'configuration_id'
    ];

    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    public function configuration() {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }
    public function attachments() {
        return $this->hasMany('App\Models\ContactAttachment', 'contact_id');
    }
    public function phones() {
        return $this->hasMany('App\Models\ContactPhone', 'contact_id');
    }
    public function emails() {
        return $this->hasMany('App\Models\ContactEmail', 'contact_id');
    }
    public function companies() {
        return $this->hasMany('App\Models\ContactCompany', 'contact_id');
    }

    public static function email($contact_id) {
        return ContactEmail::where('contact_id', $contact_id)->first()->email;
    }
    public static function phone($contact_id) {
        return ContactPhone::where('contact_id', $contact_id)->first()->phone;
    }
    public static function quote($contact_id) {
        return Order::where('customer_id', $contact_id)->count();
    }
}