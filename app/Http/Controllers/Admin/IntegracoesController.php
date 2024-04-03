<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Integracoes;
use App\Models\IntegracoesParametros;
use Illuminate\Http\Request;

class IntegracoesController extends Controller
{
    public function index(Request $request){
        $listaIntegracoes = [
            'eadsimples',
            'asaas',
        ];
        asort($listaIntegracoes);
        return view('admin.integracoes.index',compact('listaIntegracoes'));
    }
    public function configuracoes(Request $request,$slug){

        $integracao = Integracoes::empresa()->where('nome',$slug)->first();
       
        return view('admin.integracoes.'.$slug,compact('integracao'));
    }

    public function store(Request $request){
        $data = $request->except('_token');
        Integracoes::where('id',$data['id_integracao'])->update([
            'status'=>$data['status'],
        ]);
        IntegracoesParametros::updateOrCreate([
            'id_integracao'=>$data['id_integracao'],
        ],[
            'endpoint_producao'     => $data['endpoint_producao'],
            'endpoint_sandbox'      => $data['endpoint_sandbox'],
            'cliente_id'            => $data['cliente_id'],
            'token_public'          => $data['token_public'],
            'token_private'         => $data['token_private'],
            'ativado'               => $data['ativado'],
        ]);

        return response()->json(['status'=>'ok']);
    }
}
