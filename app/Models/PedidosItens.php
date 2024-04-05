<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosItens extends Model
{
    use HasFactory;

    protected $table = 'pedidos_itens';
    protected $fillable = [
            'id_pedido',
            'id_produto',
            'valor',
            'valor_desconto',
            'valor_final',
    ];
    public function produto(){
        return  $this->hasOne(Produtos::class,'id','id_produto');
    }
}
