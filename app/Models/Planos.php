<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planos extends Model
{
    protected $table = 'planos';

    protected $fillable = [
        'nome',
        'publico',
        'descricao',
        'qtd_licencas',
        'valor',
        'valor_anual',
        'valor_promocional',
        'dias_trial',
        'status',
        'recomendado',
    ];
    public function modulos(){
        return $this->hasMany(PlanosModulos::class,'id_plano','id');
    }
}
