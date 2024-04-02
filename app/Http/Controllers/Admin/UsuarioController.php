<?php

namespace App\Http\Controllers\Admin;

use App\Models\Empresas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{


// LISTA
    public function index(Request $request){
        
        $empresa_id = Auth::user()->id_empresa;

        $usuarios = User::where('id_empresa', $empresa_id)->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

// SALVAR
    public function store(Request $request){

       $empresa_id = Auth::user()->id_empresa;

        $data = $request->all();
        $senha = Str::random(8);

        User::create([

            'name' => $data['name'],
            'email' => $data['email'],
            'id_empresa' => $empresa_id,
            'password' => bcrypt($senha)
        ]);

// Enviar email e senha para o novo usuario -> 'usuarios.bem-vindo.blade'
        $dataSender['sendMail'] = strtolower($data['email']);
        $dataSender['sendName'] = $data['name'];
        $dataSender['senha']  = $senha;
        $dataSender['url']  = 'https://dca.developers.com.br';
    
        Mail::send('usuarios.bem-vindo', $dataSender, function ($m) use ($dataSender){
                    $m->from('send@dvelopers.com.br', 'DCA - Devolução com Amor');
                    $m->to($dataSender['sendMail'], $dataSender['sendName'])->subject('Bem Vindo ao DCA');       
        });

        $usuarios = User::where('id_empresa', Auth::user()->id_empresa)->get();

        return view('admin.usuarios._list-usuarios', compact('usuarios'));
    }

// EDIT
    public function edit(Request $request, $id){
                
        $usuario = User::find($id);

        return view('admin.usuarios.cadastrar', compact('usuario'));

    }

//UPDATE   
    public function update(Request $request,$id)   {
                
        $data=$request->except('_token'); //recebe as informações no objeto.

        User::where('id',$id)->update([

            'name' => $data['name'],
            'email'=> $data['email'],
           // 'role' => $data['role']
        ]);

        $usuarios = User::where('id_empresa', Auth::user()->id_empresa)->get();

        return view('admin.usuarios._list-usuarios', compact('usuarios'));
    }

// DELETAR
    public function delete(Request $request,$id)   {

        $usuario = User::find($id);
        $usuario-> delete();

        $usuarios = User::where('id_empresa', Auth::user()->id_empresa)->get();
        
        return view('admin.usuarios._list-usuarios', compact('usuarios'));
    }

// SELECT STATUS
    public function status(Request $request){

        $data = $request->all();
        User::where('id',$data['id'])->update(['status'=> $data['status']]);

        if(Auth::User()->role == "master"){

            $usuarios = User::all();
        }

        if(Auth::User()->role == "admin"){

            $empresa_id = Auth::User()->id_empresa;
            $usuarios = User::where('id_empresa', $empresa_id)->get();
        }
        
        return view('admin.usuarios._list-usuarios', compact('usuarios'));
    }

   
}
