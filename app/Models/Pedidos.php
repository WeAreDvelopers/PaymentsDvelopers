<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = [
        'numero_pedido',
        'id_user',
        'id_produto',
        'id_empresa',
        'id_cupom',
        'valor',
        'valor_desconto',
        'valor_final',
    ];

    public function itens(){
        return  $this->hasMany(PedidosItens::class,'id_pedido','id');
    }

    public function empresa(){
        return  $this->hasOne(Empresas::class,'id','id_empresa');
    }
    public function cliente(){
        return  $this->hasOne(User::class,'id','id_user');
    }

    public function cupom(){
        return  $this->hasOne(Cupons::class,'id','id_cupom');
    }

  
}
