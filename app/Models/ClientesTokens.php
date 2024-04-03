<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientesTokens extends Model
{
    use HasFactory;
    protected $table = 'clientes_tokens';
    protected $fillable = [
        'id_empresa',
        'id_user',
        'id_asaas',
    ];
}
