<?php

namespace App\Http\Controllers\Admin;

use App\Models\Empresas;
use App\Models\GatewaysPagamento;
use Illuminate\Http\Request;

class GatewaysController extends Controller
{
    public function index(){
        $gateways = GatewaysPagamento::all();
        return view('admin.gateways.index',compact('gateways'));
    }
    public function store(Request $request){
        $request->except('_token');
        $request->validate([
            'descricao' => 'required|string|max:255',
            'taxa_padrao' => 'required',
        ]);

        $gateway = new GatewaysPagamento;
        $gateway->descricao = $request->input('descricao');
        $gateway->status = $request->input('status');

        $taxa_padrao = str_replace(',', '.', str_replace('.', '', $request->input('taxa_padrao')));

        $gateway->taxa_padrao = $taxa_padrao;

        if (!$request->filled('status')) {
            $gateway->status = 'inativo';
        }

        $gateway->save();

        return response()->json([
            'status'=>'ok',
        ]);
    }
    public function edit(Request $require,$id){
        $gateway = GatewaysPagamento::find($id);
        return response()->json($gateway);
    }

    public function update(Request $request){

        $request->except('_token');
        $request->validate([
            'descricao' => 'required|string|max:255',
            'taxa_padrao' => 'required',
        ]);

        $id = $request->input('id');

        $gateway = GatewaysPagamento::find($id);

        $gateway->descricao = $request->input('descricao');
        $gateway->status = $request->input('status');

        $taxa_padrao = str_replace(',', '.', str_replace('.', '', $request->input('taxa_padrao')));

        $gateway->taxa_padrao = $taxa_padrao;

        if (!$request->filled('status')) {
            $gateway->status = 'inativo';
        }

        $gateway->save();

        return response()->json('editado');
    }

    public function delete(Request $request,$id)   {

        $gateway = GatewaysPagamento::find($id);

        $gateway->delete();

        return response(200);
    }
}
