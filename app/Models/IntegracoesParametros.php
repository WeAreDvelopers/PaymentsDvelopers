<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegracoesParametros extends Model
{
    use HasFactory;
    protected $table = 'integracoes_parametros';
    protected $fillable = [
        'id_integracao',
        'endpoint_producao',
        'endpoint_sandbox',
        'cliente_id',
        'token_public',
        'token_private',
        'ativado',
    ];

    public function apiUrl(){
      
        if($this->ativado == 'sandbox'){
            return $this->endpoint_sandbox;
        }else{
            return $this->endpoint_producao;
        }
    }
}
