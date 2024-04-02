<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bandeiras;
use App\Models\Empresas;
use App\Models\FormasPagamentos;
use App\Models\GatewaysPagamento;
use Illuminate\Http\Request;
use Image;

class FormasPagamentoController extends Controller
{
    public function index(){
        $formas_pagamentos = FormasPagamentos::all();
        return view('admin.formas_pagamentos.index',compact('formas_pagamentos'));
    }
    public function new(){

        $empresas = Empresas::select()->distinct()->get();
        $gateways = GatewaysPagamento::select()->distinct()->get();
        $bandeiras = Bandeiras::select()->distinct()->get();
        $forma_pagamento = NULL;

        return view('admin.formas_pagamentos.new', compact('empresas', 'gateways', 'bandeiras', 'forma_pagamento'));
    }
    public function store(Request $request){
        $request->except('_token');
        $request->validate([
            'id_empresa' => 'required',
            'id_gateway' => 'required',
            'descricao' => 'required',
            'tipo' => 'required',
        ]);

        $forma_pagamento = new FormasPagamentos;
        $forma_pagamento->id_empresa = $request->input('id_empresa');
        $forma_pagamento->id_gateway = $request->input('id_gateway');
        $forma_pagamento->descricao = $request->input('descricao');
        $forma_pagamento->tipo = $request->input('tipo');
        $forma_pagamento->id_bandeira = $request->input('id_bandeira');
    
        if ($request->filled('taxa_real')) {
            $taxa_real = str_replace(',', '.', str_replace('.', '', $request->input('taxa_real')));
            $forma_pagamento->taxa_real = $taxa_real;
        }
        if ($request->filled('taxa_porc')) {
            $taxa_porc = str_replace(',', '.', str_replace('.', '', $request->input('taxa_porc')));
            $forma_pagamento->taxa_porc = $taxa_porc;
        }

        if ($request->filled('status') == false) {
            $forma_pagamento->status = 'inativo';
        }else{
            $forma_pagamento->status = 'ativo';
        }

        $forma_pagamento->save();

        return response()->json([
            'status'=>'ok',
        ]);
    }
    public function edit(Request $require,$id){
        $forma_pagamento = FormasPagamentos::find($id);
        $empresas = Empresas::select()->distinct()->get();
        $gateways = GatewaysPagamento::select()->distinct()->get();
        $bandeiras = Bandeiras::select()->distinct()->get();
   
        return view('admin.formas_pagamentos.edit', compact('empresas', 'gateways', 'bandeiras', 'forma_pagamento'));
    }

    public function update(Request $request,$id){

        $request->except('_token');
        $request->validate([
            'id_empresa' => 'required',
            'id_gateway' => 'required',
            'descricao' => 'required',
            'tipo' => 'required',
        ]);

        $forma_pagamento = FormasPagamentos::find($id);
        $forma_pagamento->id_empresa = $request->input('id_empresa');
        $forma_pagamento->id_gateway = $request->input('id_gateway');
        $forma_pagamento->descricao = $request->input('descricao');
        $forma_pagamento->tipo = $request->input('tipo');
        $forma_pagamento->id_bandeira = $request->input('id_bandeira');
    
        if ($request->filled('taxa_real')) {
            $taxa_real = str_replace(',', '.', str_replace('.', '', $request->input('taxa_real')));
            $forma_pagamento->taxa_real = $taxa_real;
        }
        if ($request->filled('taxa_porc')) {
            $taxa_porc = str_replace(',', '.', str_replace('.', '', $request->input('taxa_porc')));
            $forma_pagamento->taxa_porc = $taxa_porc;
        }

        if ($request->filled('status') == false) {
            $forma_pagamento->status = 'inativo';
        }else{
            $forma_pagamento->status = 'ativo';
        }

        $forma_pagamento->save();

        return response()->json([
            'status'=>'ok',
            'url'=>route('app.formas_pagamentos.index'),
        ]);
    }

    public function delete(Request $request,$id)   {

        $forma_pagamento = FormasPagamentos::find($id);

        $forma_pagamento->delete();

        return response(200);
    }

    public function uploadProfile(Request $request){
        $arrayFile = array();
       
        $data = $request->all();
        $file = $request->file;
        
      
      
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
    
    
            $e = explode(".",$file->getClientOriginalName());
            $n = str_replace(end($e), "", $file->getClientOriginalName());
            $newName =  session()->getId() . ".".end($e) ;
            $request->session()->put('foto', $newName);
            $extension = strtolower(end($e));
            $fileName =  $newName;
            $arrayFile[] = $fileName;
            $file->move("storage/profiles/",$fileName);
    
            if(in_array($extension, $imageExtensions))
            {
            if(@is_array(getimagesize("storage/profiles/".$fileName))){
                Image::configure(array('driver' => 'imagick'));
                $width = Image::make("storage/profiles/".$fileName)->width();
                if($width > 512){
                    $image = Image::make("storage/profiles/".$fileName)->resize(512, null,function ($constraint) {
                        $constraint->aspectRatio();
                    });
                       $image->save("storage/profiles/".$fileName,85);
                 }
                
            }
            }
        
        return response()->json($arrayFile);
    }

    public function storeBandeira(Request $request){
        $request->except('_token');
        $request->validate([
            'nome' => 'required',
            'file' => 'required',
        ]);

        $bandeira = new Bandeiras;
        $bandeira->nome = $request->input('nome');
        $bandeira->file = $request->input('file');
        

        $bandeira->save();

        $bandeiras = Bandeiras::select()->distinct()->get();

        $forma_pagamento = null;
   
        return view('admin.formas_pagamentos._bandeiras', compact('bandeiras', 'forma_pagamento'));
    }
}
