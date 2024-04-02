<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaPagamento extends Model
{
    protected $table = 'empresas_pagamento';

    protected $fillable = [
        'id_empresa',
        'id_plano',
        'status',
        'taxa_pagamento',
        'valor',
        'valor_liquido',
        'data_vencimento',
        'metodo_pagamento',
        'total_licencas',
        'subscription',
        'forma_pagamento',
    ];

    public function plano(){
        return $this->hasOne(Planos::class,'id','id_plano');
    }
}
