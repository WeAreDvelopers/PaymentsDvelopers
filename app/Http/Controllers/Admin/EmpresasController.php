<?php

namespace App\Http\Controllers\Admin;

use App\Models\Empresas;
use Illuminate\Http\Request;
use Auth;
class EmpresasController extends Controller
{
    public function index(){
        $empresas = Empresas::get();
       
        return view('admin.empresas.index',compact('empresas'));
    }
    public function new(){
   
        return view('admin.empresas.new');
    }
    public function store(Request $request){
        $request->except('_token');
        $request->validate([
            'nome' => 'required|string|max:255',
            'nome_contato' => 'required|string|max:255',
            'telefone_contato' => 'required|string|min:11',
            'cnpj' => 'required|string|unique:empresas',
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'email_contato' => 'required|email|unique:empresas',
        ]);

        $empresa = new Empresas;
        $empresa->nome = $request->input('nome');
        $empresa->nome_contato = $request->input('nome_contato');
        $empresa->telefone_contato = $request->input('telefone');
        $empresa->cnpj = $request->input('cnpj');
        $empresa->cep = $request->input('cep');
        $empresa->endereco = $request->input('endereco');
        $empresa->numero = $request->input('numero');
        $empresa->cidade = $request->input('cidade');
        $empresa->estado = $request->input('estado');
        $empresa->email_contato = $request->input('email');
        $empresa->status = $request->input('status');

        if ($request->filled('status') == false) {
            $empresa->status = 'inativo';
        }else{
            $empresa->status = 'ativo';
        }

        if ($request->filled('complemento')) {
            $empresa->complemento = $request->input('complemento');
        }

        $empresa->save();

        return response()->json([
            'status'=>'ok',
        ]);
    }
    public function edit(Request $require,$id){
        $empresa = Empresas::find($id);
        if(Auth::user()->role == 'admin'){
            $empresa = Empresas::find(Auth::user()->id_empresa);
        }
        
        return view('admin.empresas.edit',compact('empresa'));
    }

    public function show(Request $require,$id){
        $empresa = Empresas::find($id);
        if(Auth::user()->role == 'admin'){
            $empresa = Empresas::find(Auth::user()->id_empresa);
        }
        return response()->json($empresa);
    }

    public function update(Request $request,$id){
        $empresa = Empresas::find($id);
        if(Auth::user()->role == 'admin'){
            $empresa = Empresas::find(Auth::user()->id_empresa);
        }       
        $request
        ->except('_token');
        $request->validate([
            'nome' => 'required|string|max:255',
            'nome_contato' => 'required|string|max:255',
            'telefone_contato' => 'required|string|min:11',
            'cnpj' => 'required|string|unique:empresas,id,'.$empresa->id,
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'email_contato' => 'required|email|unique:empresas,id,'.$empresa->id,
        ]);
        
        $empresa->nome = $request->input('nome');
        $empresa->nome_contato = $request->input('nome_contato');
        $empresa->telefone_contato = $request->input('telefone_contato');
        $empresa->cnpj = $request->input('cnpj');
        $empresa->cep = $request->input('cep');
        $empresa->endereco = $request->input('endereco');
        $empresa->numero = $request->input('numero');
        $empresa->cidade = $request->input('cidade');
        $empresa->estado = $request->input('estado');
        $empresa->email_contato = $request->input('email_contato');
        $empresa->id_logo = $request->input('id_logo');
        $empresa->status = $request->input('status');

        if ($request->filled('complemento')) {
            $empresa->complemento = $request->input('complemento');
        }

        if ($request->filled('status') == false) {
            $empresa->status = 'inativo';
        }else{
            $empresa->status = 'ativo';
        }

        if ($empresa->cnpj != $request->input('cnpj')){
            $request->validate([
                'cnpj' => 'required|string|unique:empresas',
            ]);
            $empresa->cnpj = $request->input('cnpj');
        }

        if ($empresa->email != $request->input('email')){
            $request->validate([
                'email' => 'required|email|unique:empresas',
            ]);
            $empresa->email = $request->input('email');
        }

        $empresa->save();

        return response()->json([
            'status'=>'ok',
            
        ]);
    }

    public function delete(Request $request,$id)   {

        $empresa = Empresas::find($id);
        if(Auth::user()->role == 'admin'){
            $empresa = Empresas::find(Auth::user()->id_empresa);
        }

        $empresa->delete();

        return response(200);
    }
}
