<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bandeiras extends Model
{
    use HasFactory;

    protected $table = 'bandeiras';

    protected $fillable = [      
        'nome',
        'file',
    ];
}
