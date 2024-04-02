<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categorias;
use App\Models\Empresas;
use App\Models\FormasPagamentos;
use App\Models\Grupos;
use App\Models\Pagamentos;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresas = null;
      
        if(Auth::user()->role == 'master'){
            $empresas = Empresas::all();
        
        }
        $id = null;
        return view('admin.dashboard.index',compact('empresas', 'id'));
    }

    public function buscar($id = null)
    {
        return view('admin.dashboard._dash',compact('id'));
    }


    public function ultimosPagamentos(Request $request,$id = false){
       
        if(!$id){
         
            $id = Auth::user()->id_empresa;
        }

        $pagamentos = Pagamentos::where('id_empresa',$id)->get()->groupBy(function($q){
            return $q->created_at->format('d/m/Y');
        })->map(function($q) {
            return $q->take(100);
        });;
        
        return view('admin.dashboard.include._ultimos',compact('pagamentos'));
    }

    public function graficoCategorias(Request $request, $id = false)
{
    if (!$id) {
        $id = Auth::user()->id_empresa;
    }

    $grupos = Grupos::where('id_empresa', $id)->get();
    $dados_grafico = [];

    foreach ($grupos as $grupo) {
        $categorias = 0;
        $categorias = Categorias::where('id_grupo', $grupo->id)->count();
        $dados_grafico[] = [
            'grupos' => $grupo->descricao,
            'categorias' => $categorias,
        ];
    }

    return response()->json($dados_grafico);
}

public function graficoProdutos(Request $request, $id = false)
{
    if (!$id) {
        $id = Auth::user()->id_empresa;
    }

    $categorias = Categorias::where('id_empresa', $id)->get();
    $dados_grafico = [];

    foreach ($categorias as $categoria) {
        $produtos = 0;
        $produtos = Produtos::where('id_categoria', $categoria->id)->count();
        $dados_grafico[] = [
            'categorias' => $categoria->grupo->descricao . ' - ' . $categoria->descricao,
            'produtos' => $produtos,
        ];
    }

    return response()->json($dados_grafico);
}

public function graficoPagamentos(Request $request, $id = false)
{
    if (!$id) {
        $id = Auth::user()->id_empresa;
    }

    $formas_pagamentos = FormasPagamentos::where('id_empresa', $id)->get();
    $dados_grafico = [];

    foreach ($formas_pagamentos as $forma_pagamento) {
        $pagamentos = 0;
        $pagamentos = Pagamentos::where('id_forma_pagamento', $forma_pagamento->id)->count();
        $dados_grafico[] = [
            'formas_pagamentos' => $forma_pagamento->descricao,
            'pagamentos' => $pagamentos,
        ];
    }

    return response()->json($dados_grafico);
}

public function graficoValores(Request $request, $id = false)
{
    if (!$id) {
        $id = Auth::user()->id_empresa;
    }

    $formas_pagamentos = FormasPagamentos::where('id_empresa', $id)->get();
    $dados_grafico = [];

    foreach ($formas_pagamentos as $forma_pagamento) {
        $pagamentos = 0;
        $valor = 0;
        $pagamentos = Pagamentos::where('id_forma_pagamento', $forma_pagamento->id)->get();

        foreach ($pagamentos as $pagamento){
            $valor = $valor + $pagamento->valor;
        }

        if ($valor){
            $dados_grafico[] = [
                'formas_pagamentos' => $forma_pagamento->descricao,
                'valores' => $valor,
            ];
        }
    }

    return response()->json($dados_grafico);
}

}
