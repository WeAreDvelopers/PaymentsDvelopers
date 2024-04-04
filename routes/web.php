<?php

use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\CuponsController;
use App\Http\Controllers\Admin\DCATaxasController;
use App\Http\Controllers\Admin\EmpresasController;
use App\Http\Controllers\Admin\FormasPagamentoController;
use App\Http\Controllers\Admin\GatewaysController;
use App\Http\Controllers\Admin\GrupoController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\IntegracoesController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProdutosController;
use App\Http\Controllers\Admin\PedidosController;

use App\Http\Controllers\Admin\TaxasDvelopersController;
use App\Http\Controllers\Admin\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\PdfController;


// Route::middleware('checksubdomain')->group(function () {

    Route::name('site.')->group(function () {
            Route::get('/pagamento/{token?}', [PagamentoController::class, 'index'])->name('pagamento');
            Route::post('save-data', [PagamentoController::class, 'saveUserData'])->name('saveUserData');
            Route::get('/pdf', [PdfController::class, 'adicionarInformacoes'])->name('pdf');
            Route::get('/email', [IndexController::class, 'email'])->name('email');
            Route::get('/updateAdvertise', [IndexController::class, 'updateUserAdvertiseData'])->name('updateUserAdvertiseData');
            Route::post('capturaLead/{token}', [PagamentoController::class, 'capturaLead'])->name('capturaLead');
            Route::post('createBaseAccount/{token}', [PagamentoController::class, 'createBaseAccount'])->name('createBaseAccount');
            Route::get('carrinho', [PagamentoController::class, 'carrinho'])->name('carrinho');
            Route::post('aplicarCupom', [PagamentoController::class, 'aplicarCupom'])->name('aplicarCupom');
            Route::domain('{subdomain}.numerosnaomentem.app.br')->group(function () {
                Route::get('/{slug?}', [IndexController::class, 'index'])->name('index');
            
            });
    });
// });


Auth::routes();
Route::name('admin.')->prefix('admin')->middleware(['auth'])->group(function () {

     Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::name('dash.')->prefix('dash')->controller(HomeController::class)->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/ultimosPagamentos/{id?}', 'ultimosPagamentos')->name('ultimosPagamentos');
        Route::get('/graficoCategorias/{id?}', 'graficoCategorias')->name('graficoCategorias');
        Route::get('/graficoProdutos/{id?}', 'graficoProdutos')->name('graficoProdutos');
        Route::get('/graficoPagamentos/{id?}', 'graficoPagamentos')->name('graficoPagamentos');
        Route::get('/graficoValores/{id?}', 'graficoValores')->name('graficoValores');
        Route::get('/buscar/{id?}', 'buscar')->name('buscar');
    });
    Route::name('empresas.')->prefix('empresas')->controller(EmpresasController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });
    Route::name('formas_pagamentos.')->prefix('formas_pagamentos')->controller(FormasPagamentoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::post('/store', 'store')->name('store');
        Route::post('/storeBandeira', 'storeBandeira')->name('storeBandeira');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/uploadProfile', 'uploadProfile')->name('uploadProfile');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    Route::name('gateways.')->prefix('gateways')->controller(GatewaysController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    Route::name('dca_taxas.')->prefix('dca_taxas')->controller(TaxasDvelopersController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

    Route::name('usuarios.')->prefix('usuarios')->controller(UsuarioController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::match(['get', 'post'], '/usuarios/status', 'status')->name('status');
    });

   
    Route::name('cupons.')->prefix('cupons')->controller(CuponsController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');
        Route::match(['get', 'post'], '/categorias/status', 'status')->name('status');
    });
    

    Route::name('produtos.')->prefix('produtos')->controller(ProdutosController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');

        Route::match(['get', 'post'], '/produtos/status', 'status')->name('status');
        Route::get('/select_grupo/{grupoId}', 'selectGrupo')->name('selectGrupo');

    });
    Route::name('integracoes.')->prefix('integracoes')->controller(IntegracoesController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/configuracoes/{slug}', 'configuracoes')->name('configuracoes');
        Route::post('/store', 'store')->name('store');
    });

// Pedidos
    Route::name('pedidos.')->prefix('pedidos')->controller(PedidosController::class)->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/delete/{id}', 'delete')->name('delete');

        Route::get('/preview/{id}', 'preview')->name('preview');

   });



    Route::name('media.')->prefix('media')->controller(MediaController::class)->group(function () {
        Route::get('/popUp/{folder?}', 'popUp')->name('popUp');
        Route::post('/list-folder/{folder?}', 'listFiles')->name('list-files');
        Route::post('/newFolder', 'newFolder')->name('newFolder');
        Route::get('/delFolder', 'delFolder')->name('delFolder');
        Route::get('/getFile/{id?}', 'getFile')->name('getFile');
        Route::get('/{folder??}', 'index')->name('index');
        Route::get('/tokenUrl', 'tokenUrl')->name('tokenUrl');
        Route::post('/upload-media', 'moveFile')->name('upload-media');
        Route::post('/delete-media', 'deleteFile')->name('delete-media');
        
      
      
    });
});
