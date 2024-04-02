<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamentos extends Model
{
    use HasFactory;
    protected $table = 'pagamentos';

    protected $fillable = [
        'id_empresa',
        'transacao_key',
        'id_geteway',
        'valor',
        'id_forma_pagamento',
        'bandeira',
        'status',
        'taxa',
        'valor_liquido',
    ];

    public function produtos(){
        return $this->hasMany(PagamentosProdutos::class,'id_pagamento','id');
    }
    public function formaPagamento(){
        return $this->hasOne(FormasPagamentos::class,'id','id_forma_pagamento');
    }
    public function geteway(){
        return $this->hasOne(GatewaysPagamento::class,'id','id_geteway');
    }
}
