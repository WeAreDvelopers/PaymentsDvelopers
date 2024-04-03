<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DadosClientes extends Model
{
    use HasFactory;
    protected $table = 'dados_clientes';
    protected $fillable = [
        'id_user',
        'cpf',
        'telefone',
        'id_asaas',
    ];


}
