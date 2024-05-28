<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorias;
use App\Models\Grupos;
use App\Models\Popup;
use App\Models\Produtos;
use App\Services\EadSimplesService;
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

       
        $data = $request->all();
      
        $token = Str::random(10);

        $status = isset($data['status']) ? $data['status'] : 'inativo';
        $status_popup = isset($data['status_popup']) ? $data['status'] : 'inativo';


        $produto = Produtos::create([
          
            'id_empresa' => Auth::user()->id_empresa,
            'nome' => $data['nome'],
           
            'id_media'=> $data['id_media'],
            'tipo' => $data['tipo'],
            'status'=> $status,
            'token' => $token,
            'max_parcelas' => $data['max_parcelas'],
            'descricao' => $data['descricao'],
            'valor' => saveMoney($data['valor'])
        ]);

        Popup::create([

            'id_produto'=> $produto->id,
            'status' =>  $status_popup,
            'id_popup'=> $data['id_popup'],
            'informativo' => $data['informativo']

        ]);

        if(@$data['ead_simples_curso']){
            $service = new EadSimplesService(Auth::user()->empresa->checkIntegracao('eadsimples'));
            $service->cadastrarProduto([
                'id_produto'=>$produto->id,
                'id_produto_ead'=>$data['ead_simples_curso'],
            ]);
        }

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

    $status = isset($data['status']) ? $data['status'] : 'inativo';
    $status_popup = isset($data['status_popup']) ? $data['status'] : 'inativo';
    
    Produtos::where('id',$id)->update([
            'nome' => $data['nome'],
            'id_media'=> $data['id_media'],
            'tipo' => $data['tipo'],
            'status'=>  $status,
            'max_parcelas' => $data['max_parcelas'],
            'descricao' => $data['descricao'],
            'valor' => saveMoney($data['valor'])
    ]);
    
    Popup::where('id',$data['id'])->update([

        
        'status' => $status_popup,
        'id_popup'=> $data['id_popup'],
        'informativo' => $data['informativo']

    ]);

    return response()->json(['status'=>'ok'],200);
    }

// DELETAR
    public function delete(Request $request,$id)   {

        $produto = Produtos::find($id);
        $produto-> delete();

        $popup = Popup::where('id', $produto->id);
        $popup-> delete();

        return response()->json(['status'=>'ok'],200);
    }

// SELECT STATUS
public function status(Request $request){

    $data = $request->all();
    
    Produtos::where('id',$data['id'])->update(['status'=> $data['status']]);

    return response()->json([ 'Status' => 'Alterado com sucesso']);
}


}
