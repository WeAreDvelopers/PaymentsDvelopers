<?php

namespace App\Http\Controllers\Admin;

use App\Models\Grupos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrupoController extends Controller
{

// LISTA
    public function index(Request $request){
            
        $empresa_id = Auth::user()->id_empresa;

        $grupos = Grupos::where('id_empresa', $empresa_id)->get();

        return view('admin.grupos.index', compact('grupos'));
    }

// SALVAR
    public function store(Request $request){

        $data = $request->all();

        $request->validate([
           
            'descricao' => 'unique',
           
        ],[
           //  'grupo' => 
        ]);

        Grupos::create([

            'id_empresa' => Auth::user()->id_empresa,
            'descricao' => $data['descricao']
        ]);

        $grupos = Grupos::where('id_empresa', Auth::user()->id_empresa)->get();

        return view('admin.grupos._list-grupos', compact('grupos'));
    }

// EDIT
    public function edit(Request $request, $id){
                
        $grupo = Grupos::find($id);

        return view('admin.grupos.cadastrar', compact('grupo'));

    }

//UPDATE   
    public function update(Request $request,$id)   {
                
        $data=$request->except('_token'); //recebe as informações no objeto.

        Grupos::where('id',$id)->update([

            'descricao' => $data['descricao']
        ]);

        $grupos = Grupos::where('id_empresa', Auth::user()->id_empresa)->get();

        return view('admin.grupos._list-grupos', compact('grupos'));
    }

// DELETAR
    public function delete(Request $request,$id)   {

        $grupo = Grupos::find($id);
        $grupo-> delete();

        $grupos = Grupos::where('id_empresa', Auth::user()->id_empresa)->get();
        
        return view('admin.grupos._list-grupos', compact('grupos'));
    }

// SELECT STATUS
    public function status(Request $request){

        $data = $request->all();
        Grupos::where('id',$data['id'])->update(['status'=> $data['status']]);

        if(Auth::User()->role == "master"){

            $grupos = Grupos::all();
        }

        if(Auth::User()->role == "admin"){

            $empresa_id = Auth::User()->id_empresa;
            $grupos = Grupos::where('id_empresa', $empresa_id)->get();
        }
        
        return view('admin.grupos._list-grupos', compact('grupos'));
    }
}
