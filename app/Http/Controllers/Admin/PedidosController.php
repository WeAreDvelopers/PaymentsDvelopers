<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use App\Models\DadosClientes;
use App\Models\Pedidos;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
   
// Lista

    public function index(Request $request)
    {

       $pedidos = Pedidos::all();

        return view('admin.pedidos.index', compact('pedidos'));
        
    }

// Preview
    public function preview (Request $request, $id){

        $cliente = Auth::user();
       

        $dados_cliente = DadosClientes::where('id_user', $cliente->id)->first();
       
        $pedido = Pedidos::find($id);

        return view('admin.pedidos.preview', compact('pedido', 'dados_cliente', 'cliente'));
    }


}
