<?php
/**
 * Created by PhpStorm.
 * User: alfju
 * Date: 9/15/2018
 * Time: 18:36
 */

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Document extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'documents';
    protected $fillable = [
        'name',
        'description',
        'type',
        'file',
        'extension',
        'size',
        'date',
        'time',
        'status_id',
        'configuration_id'
    ];

    public function status() {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    public function configuration() {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }
    public static function user($id)
    {
        $getUserId = DocumentUser::where('document_id', $id)->first();
        $getUser = User::where('id', $getUserId->user_id)->first();
        return $getUser->name;
    }
}