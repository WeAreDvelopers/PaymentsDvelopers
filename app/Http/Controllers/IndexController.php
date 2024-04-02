<?php

namespace App\Http\Controllers;

use App\Models\Planos;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request,$slug = null){
  

        $subdomain = $request->get('subdomain') ?? $slug;
        $plano = Planos::where('slug',$subdomain)->first();
      
        return view($subdomain .'.index',compact('plano'));
    }
    public function email(){
        $nome = "Rafael William Malgueiro Badari";
        return view('emails.compra',compact('nome'));
    }
}
