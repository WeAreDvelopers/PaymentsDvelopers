<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    use HasFactory;
    protected $table = 'empresas';

    protected $fillable = [      
        'nome',
        'cnpj',
        'cep',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'token_asaas',
        'nome_contato',
        'email_contato',
        'telefone_contato',
        'id_logo',
        'statu',
    ];

    public function media(){
        return $this->hasOne(Media::class,'id','id_logo');
    }

    public function checkIntegracao($name){
       
        $check = Integracoes::where('nome',$name)->first();
        if(!$check){
            $check =  Integracoes::create([
                'id_empresa'=>$this->id,
                'nome'=>$name,
                'status'=>'inativo',
            ]);
        }
        return $check;
    }

}
