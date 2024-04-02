<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagamentosProdutos extends Model
{
    use HasFactory;
    protected $table = 'pagamentos_produtos';
   
   
    protected $fillable = [
        'id_pagamento',
        'id_produto',
        'qtd',
        'valor',
    ];



}
