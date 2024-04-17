<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use App\Models\DadosClientes;
use App\Models\Pedidos;
use App\Models\PedidosItens;
use App\Models\Produtos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
   
// Lista

    public function index(Request $request)
    {

        $empresa_id = Auth::user()->id_empresa;
 

        $pedidos = Pedidos::where('id_empresa', $empresa_id)->get();
    
        return view('admin.pedidos.index', compact('pedidos'));
        
    }

    public function preview (Request $request, $id){
       
        $pedido = Pedidos::find($id);

        return view('admin.pedidos.preview', compact('pedido'));
    }


}
