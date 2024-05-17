<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;

use App\Models\Categorias;
use App\Models\Cupons;
use App\Models\Empresas;
use App\Models\FormasPagamentos;
use App\Models\Grupos;
use App\Models\Pagamentos;
use App\Models\Pedidos;
use App\Models\Produtos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $cupons_disponiveis = Cupons::sum('qtd');
        $cupons_utilizados = Pedidos::whereNotNull('id_cupom')->count();
        $cupons_total =  $cupons_disponiveis + $cupons_utilizados;

        $pedidos_total = Pedidos::count();
        $faturamento = Pedidos::sum('valor_final');

        $Cupons = [       
            
            'labels' => ['Disponiveis', 'Utilizados'],
            'qtd' => [(int)$cupons_disponiveis, (int) $cupons_utilizados ],
        ];




// Grafico Pie or Donit
        $result = Pedidos::join('pedidos_itens', 'pedidos.id', '=', 'pedidos_itens.id_pedido')
        ->join('produtos', 'pedidos_itens.id_produto', '=', 'produtos.id')
        ->select('produtos.nome', DB::raw('count(pedidos_itens.id_produto) as quantidade'))
        ->groupBy('produtos.nome')
        ->get();

        // Formate os resultados para o gráfico
        $labels = [];
        $quantities = [];

        foreach ($result as $row) {
        $labels[] = $row->nome;
        $quantities[] = (int) $row->quantidade;
        }

        $ProdutosDonut = [
        'labels' => $labels,
        'qtd' => $quantities,
        ];

        $ProdutosLine = [
            'labels' => $labels,
            'qtd' => $quantities,
        ];
        

// Grafico Line - Mes/Ano
$result2 = Pedidos::join('pedidos_itens', 'pedidos.id', '=', 'pedidos_itens.id_pedido')
    ->join('produtos', 'pedidos_itens.id_produto', '=', 'produtos.id')
    ->select(
        'produtos.nome',
        DB::raw('MONTH(pedidos.created_at) as mes'),
        DB::raw('count(pedidos_itens.id_produto) as quantidade')
    )
    ->groupBy('produtos.nome', DB::raw('MONTH(pedidos.created_at)'))
    ->orderBy('mes')
    ->orderBy('produtos.nome')
    ->get();

// Inicialize arrays vazios para armazenar as informações
$monthLabels = [];
$productLabels = [];
$productQuantities = [];

// Crie um array associativo para mapear os meses aos índices
$monthMap = [
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    4 => 'Abril',
    5 => 'Maio',
    6 => 'Junho',
    7 => 'Julho',
    8 => 'Agosto',
    9 => 'Setembro',
    10 => 'Outubro',
    11 => 'Novembro',
    12 => 'Dezembro'
];

// Preencha os arrays com os dados dos resultados da consulta
foreach ($result2 as $row) {
    $monthName = $monthMap[$row->mes];
    if (!in_array($monthName, $monthLabels)) {
        $monthLabels[] = $monthName;
    }
    if (!in_array($row->nome, $productLabels)) {
        $productLabels[] = $row->nome;
    }
    $productQuantities[$row->nome][$monthName] = (int) $row->quantidade;
}

// Ordenar as etiquetas de meses
$monthLabels = array_values(array_unique(array_merge(array_values($monthMap), $monthLabels)));

// Inicialize arrays para os rótulos e quantidades
$labels = $monthLabels;
$datasets = [];

$colors = [
    '#000000', // Preto
    '#808080', // Cinza
    '#FF0000', // Vermelho
    '#FFA500', // Laranja
    '#FFFF00', // Amarelo
    '#008000', // Verde
    '#0000FF', // Azul
    '#800080', // Roxo
    '#FFC0CB'  // Rosa
];

foreach ($productLabels as $index => $product) {
    $data = [];
    foreach ($monthLabels as $month) {
        $data[] = isset($productQuantities[$product][$month]) ? $productQuantities[$product][$month] : 0;
    }
    $datasets[] = [
        'label' => $product,
        'data' => $data,
        'color' => $colors[$index % count($colors)]
    ];
}

// Obter o mês atual
$currentMonth = Carbon::now()->month;

// Converter os rótulos dos meses para seus equivalentes numéricos
$monthMap = [
    'Janeiro' => 1,
    'Fevereiro' => 2,
    'Março' => 3,
    'Abril' => 4,
    'Maio' => 5,
    'Junho' => 6,
    'Julho' => 7,
    'Agosto' => 8,
    'Setembro' => 9,
    'Outubro' => 10,
    'Novembro' => 11,
    'Dezembro' => 12
];

// Filtrar os meses até o mês atual
$filteredMonths = array_filter($monthLabels, function($month) use ($currentMonth, $monthMap) {
    return $monthMap[$month] <= $currentMonth;
});

// Atualizar os rótulos do gráfico
$Produtos['labels'] = array_values($filteredMonths);

$Produtos = [
    'labels' => $labels,
    'datasets' => $datasets
];








        
// Grafico LINE -------------------------------------------------------------------------------------------------
        $vendas = [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
            'qtd' => [18, 47, 98, 30, 72, 56, 35, 61],
        ];

        $vendas1 = [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August'],
            'qtd' => [14, 2, 98,45, 72, 67, 35, 23],
        ];
// -----------------------------------------------------------------------------------------------------------
        
    
        return view('admin.dashboard.index', compact('clientes','cliente_total','pedidos_total','faturamento',
                    
                     'Cupons', 'vendas', 'vendas1', 'cupons_total',
                     'ProdutosDonut', 'Produtos', 'productLabels', 'labels', 'datasets'));
        
    }












    public function buscar($id = null)
    {
        return view('admin.dashboard._dash',compact('id'));
    }


}