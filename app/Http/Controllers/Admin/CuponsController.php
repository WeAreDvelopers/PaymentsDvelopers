<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cupons;
use App\Models\Grupos;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuponsController extends Controller
{

// LISTA
    public function index(Request $request){
    
       
        $produtos = Produtos::where('status','ativo')->get();

        $cupons = Cupons::get();

        return view('admin.cupons.index', compact('cupons','produtos'));
    }

// SALVAR
    public function store(Request $request){

 

        $data = $request->all();
        $data['valor'] = saveMoney($data['valor']);
        $data['id_empresa'] = Auth::user()->id_empresa;
        Cupons::create($data);

        $cupons = Cupons::all();

        return view('admin.cupons._list-cupons', compact('cupons'));
    }

// EDIT
    public function edit(Request $request, $id){
                
        $cupom = Cupons::find($id);
        $produtos = Produtos::where('status','ativo')->get();

        return view('admin.cupons.cadastrar', compact('cupom', 'produtos'));

    }

//UPDATE   
public function update(Request $request,$id)   {
            
    $data=$request->except('_token'); //recebe as informações no objeto.

    Cupons::where('id',$id)->update([

        'descricao' => $data['descricao'],
        'id_grupo' => $data['grupo'],
    ]);

 
    $cupons = Cupons::where('id_empresa', Auth::user()->id_empresa)->get();
    $produtos = Produtos::where('status','ativo')->get();
    return view('admin.cupons._list-cupons', compact('cupons', 'produtos'));
}

// DELETAR
public function delete(Request $request,$id)   {

    $cupom = Cupons::find($id);
    $cupom-> delete();

    $cupons = Cupons::where('id_empresa', Auth::user()->id_empresa)->get();
    
    return view('admin.cupons._list-cupons', compact('cupons'));
}

// SELECT STATUS
public function status(Request $request){

    $data = $request->all();
    
    Cupons::where('id',$data['id'])->update(['status'=> $data['status']]);

    return response()->json([
        'Status' => 'Alterado com sucesso.'
    ]);
    
    //return view('admin.cupons._list-cupons', compact('cupons'));
}
}
