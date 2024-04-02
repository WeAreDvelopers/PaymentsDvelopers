<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DvelopersTaxas extends Model
{
    use HasFactory;

    protected $table = 'dvelopers_taxas';

    protected $fillable = [      
        'id_formas_pagamento',
        'taxa_porc',
        'taxa_real',
    ];

    public function forma_pagamento(){
        return $this->hasOne(FormasPagamentos::class,'id','id_formas_pagamento');
    }
}
