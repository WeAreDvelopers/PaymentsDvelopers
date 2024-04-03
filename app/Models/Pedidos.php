<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = [

        'id_user',
        'id_produto',
        
        'id_cupom',
        'valor',
        'valor_desconto',
        'valor_final',
    ];

    public function produto(){
        return  $this->hasOne(Produtos::class,'id','id_produto');
    }

    public function usuario(){
        return  $this->hasOne(User::class,'id','id_user');
    }

    public function cupom(){
        return  $this->hasOne(Cupons::class,'id','id_cupom');
    }
}
