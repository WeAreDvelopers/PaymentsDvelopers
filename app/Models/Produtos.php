<?php

namespace App\Models;

use App\Scopes\EmpresaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
class Produtos extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'produtos';

    protected $fillable = [
        'id_empresa',
        'nome',
        'descricao',
        'valor',
        'id_media',
        'tipo',
        'status',
        'token',
    ];
    public function scopeEmpresa($query)
        {
            return $query->where('id_empresa', '=', Auth::user()->id_empresa);
        }
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function media(){
        return $this->hasOne(Media::class,'id','id_media');
    }
    public function empresa(){
        return $this->hasOne(Empresas::class,'id','id_empresa');
    }
    public function cupons(){
        return $this->hasMany(Cupons::class,'id_produto','id');
    }
    public function pedidos(){
        return  $this->hasOne(Pedidos::class,'id_cupom','id');
    }

    public function produtosEadSimples(){
        return $this->hasOne(ProdutosEADSimples::class,'id_produto','id');
    }

   
}
