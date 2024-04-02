<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTempData extends Model
{
    protected $table = 'user_cart';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'advertise'
    ];
}
