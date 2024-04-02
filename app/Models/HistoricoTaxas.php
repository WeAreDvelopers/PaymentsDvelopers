<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoTaxas extends Model
{
    
    protected $fillable = [

        'id_empresa',
        'descricao',
        'status'
    ];
}
