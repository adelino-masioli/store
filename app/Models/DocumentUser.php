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

class DocumentUser extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'document_users';
    protected $fillable = [
        'user_id',
        'document_id'
    ];

    public function documents()
    {
        return $this->belongsToMany('App\Model\Document', 'documents');
    }
}