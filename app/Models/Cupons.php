<?php

namespace App\Models;

use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupons extends Model
{
    use HasFactory;

    protected $table = 'cupons';

    protected $fillable = [
        'id_empresa',
        'id_produto',
        'codigo',
        'qtd',
        'tipo',
        'status',
        'valor'
    ];
   
    public function scopeEmpresa($query)
        {
            return $query->where('id_empresa', '=', Auth::user()->id_empresa);
        }

    public function pedidos(){
       return  $this->hasMany(Pedidos::class,'id_cupom','id');
    }
    public function cuponsDisponiveis($id_produto){
       
        return $this->where('id_produto',$id_produto)->sum('qtd') - $this->pedidos->count();
    }
}
