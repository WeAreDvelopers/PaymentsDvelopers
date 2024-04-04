<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosEADSimples extends Model
{
    use HasFactory;
    
    protected $table = 'produtos_ead_simples';

    protected $fillable = [
        'id_integracao',
        'id_produto',
        'id_produto_ead'
    ];
}
