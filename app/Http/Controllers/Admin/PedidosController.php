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


    $usersPorMes = User::query()
        ->where('role', 'cliente')
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
        ->groupByRaw('YEAR(created_at), MONTH(created_at)')
        ->orderByRaw('YEAR(created_at), MONTH(created_at)')
        ->get();

        $clientes = [
            'labels' => [],
            'qtd' => [],
            
        ];

        $totalClientes = 0;
    
        foreach ($usersPorMes as $user) {
            $clientes['labels'][] = date('F', mktime(0, 0, 0, $user->month, 1));
            $clientes['qtd'][] = $user->count;
            $totalClientes += $user->count;
        }
        
        $cliente_total = $totalClientes;
        $pedidos_total = Pedidos::count();
        $faturamento = Pedidos::sum('valor_final');
        
        $produtos = [       
            
            'labels' => ['X-salada', 'Refrigerante', 'Agua', 'Pastel', 'Doces'],
            'qtd' => [25, 30, 15, 10, 20],
        ];

        $produtosBar = [

            'labels' => ['X-salada', 'Refrigerante', 'Agua', 'Pastel', 'Doces'],
            'qtd' => [41, 87, 69, 26, 92],
        ];

        $vendas = [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
            'qtd' => [18, 47, 98, 30, 72, 56, 35, 61],
        ];

        $vendas1 = [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
            'qtd' => [10, 40, 60, 20, 22, 27, 89, 52],
        ];

   
        return view('admin.pedidos.index', compact('clientes','cliente_total','pedidos_total','faturamento',
                    
                    'produtos','produtosBar', 'vendas', 'vendas1'));
        
    }


    public function preview (Request $request, $id){
       
        $pedido = Pedidos::find($id);

        return view('admin.pedidos.preview', compact('pedido'));
    }


}
