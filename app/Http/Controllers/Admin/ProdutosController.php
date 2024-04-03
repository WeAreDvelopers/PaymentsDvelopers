<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorias;
use App\Models\Grupos;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProdutosController extends Controller
{

// LISTA
public function index(Request $request){
                
    $empresa_id = Auth::user()->id_empresa;
 

    $produtos = Produtos::where('id_empresa', $empresa_id)->get();

    return view('admin.produtos.index', compact('produtos'));
}

public function new(Request $request){

    return view('admin.produtos.new');
}

// SALVAR
    public function store(Request $request){

       $empresa_id = Auth::user()->id_empresa;

      

        $data = $request->all();
        $token = Str::random(10);
        Produtos::create([
          
            'id_empresa' => Auth::user()->id_empresa,
            'nome' => $data['nome'],
           
            'id_media'=> $data['id_media'],
            'tipo' => $data['tipo'],
            'status'=> $data['status'],
            'token' => $token,
           
            'descricao' => $data['descricao'],
            'valor' => saveMoney($data['valor'])
        ]);

        

      return response()->json(['status'=>'ok'],200);
    }

// EDIT
    public function edit(Request $request, $id){
                
        $produto = Produtos::find($id);

        return view('admin.produtos.edit', compact('produto',));

    }

//UPDATE   
    public function update(Request $request,$id)   {
            
    $data=$request->except('_token'); //recebe as informações no objeto.

    Produtos::where('id',$id)->update([

        'descricao' => $data['descricao'],
        'id_grupo' => $data['grupo'],
        'id_categoria' => $data['categoria'],
        'valor' => saveMoney($data['valor'])
    ]);

        $grupos = Grupos::all();
        $categorias = Categorias::all();

        $produtos = Produtos::where('id_empresa', Auth::user()->id_empresa)->get();

        return view('admin.produtos._list-produtos', compact('produtos','categorias', 'grupos'));
    }

// DELETAR
    public function delete(Request $request,$id)   {

        $produto = Produtos::find($id);
        $produto-> delete();

        $grupos = Grupos::all();
        $categorias = Categorias::all();

        $produtos = Produtos::where('id_empresa', Auth::user()->id_empresa)->get();

        return view('admin.produtos._list-produtos', compact('produtos','categorias', 'grupos'));
    }

// SELECT STATUS
    public function status(Request $request){

        $data = $request->all();

        Produtos::where('id',$data['id'])->update(['status'=> $data['status']]);

        if(Auth::User()->role == "master"){

            $produtos = Produtos::all();
        }

        if(Auth::User()->role == "admin"){

            $empresa_id = Auth::User()->id_empresa;
            $grupos = Grupos::all();

            $categorias = Categorias::all();
            
            $produtos = Produtos::where('id_empresa', $empresa_id)->get();
        }

        return view('admin.produtos._list-produtos', compact('produtos','categorias', 'grupos'));
        }
        
// SELECT GRUPO
    public function selectGrupo ($grupoId){

        $categorias = Categorias::where('id_grupo', $grupoId)->get();

        return response()->json($categorias);
    }
}
