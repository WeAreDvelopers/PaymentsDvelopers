<?php

namespace App\Providers;

use App\Models\Produtos;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        $empresa_id = Auth::user()->id_empresa;
        
        $produtos = Produtos::where('id_empresa', $empresa_id)->get();


        View::share('produtos',$produtos);*/

    }
}
