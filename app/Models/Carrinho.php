<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    use HasFactory;
    protected $table = "carrinho";
    protected $fillable = [
        'session_id',
        'id_lead',
        'id_produto',
        'id_cupom',
        'valor',
        'valor_final',
    ];

    public function lead(){
        return $this->hasOne(Leads::class,'id','id_lead');
    }
    
    public function produto(){
        return $this->hasOne(Produtos::class,'id','id_produto');
    }
    public function cupom(){
        return $this->hasOne(Cupons::class,'id','id_cupom');
    }
}
