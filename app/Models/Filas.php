<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Filas extends Model
{
    
    protected $fillable = [

        'id_empresa',
        'descricao',
        'status'
    ];
}
