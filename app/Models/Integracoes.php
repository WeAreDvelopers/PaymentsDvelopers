<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class Integracoes extends Model
{
    use HasFactory;
    protected $table = 'integracoes';
    protected $fillable = [
        'id_empresa',
        'nome',
        'status',
    ];

    public function scopeEmpresa($query)
    {
        return $query->where('id_empresa', '=', Auth::user()->id_empresa);
    }

    public function parametros(){
        return $this->hasOne(IntegracoesParametros::class,'id_integracao','id');
    }
}
