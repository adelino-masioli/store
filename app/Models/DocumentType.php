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

class DocumentType extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'document_types';
    protected $fillable = [
        'type'
    ];
}