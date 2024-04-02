<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserComunicacao extends Model
{
	protected $table = 'user_comunicacao';
    protected $fillable = [
        'id_user', 'email', 'sms','telefone',
    ];
}
