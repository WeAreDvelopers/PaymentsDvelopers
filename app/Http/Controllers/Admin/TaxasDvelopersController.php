<?php

namespace App\Http\Controllers\Admin;

use App\Models\DvelopersTaxas;
use App\Models\Empresas;
use App\Models\FormasPagamentos;
use App\Models\GatewaysPagamento;
use Illuminate\Http\Request;

class TaxasDvelopersController extends Controller
{
    public function index(){
        $dca_taxas = DvelopersTaxas::all();
        $formas_pagamentos = FormasPagamentos::select()->distinct()->get();
        return view('admin.dca-taxas.index',compact('dca_taxas', 'formas_pagamentos'));
    }
    public function store(Request $request){
        $request->except('_token');
        $request->validate([
            'id_formas_pagamento' => 'required',
        ]);

        $dca_taxa = new DvelopersTaxas;
        $dca_taxa->id_formas_pagamento = $request->input('id_formas_pagamento');
        if ($request->filled('taxa_real')) {
            $taxa_real = str_replace(',', '.', str_replace('.', '', $request->input('taxa_real')));
            $dca_taxa->taxa_real = $taxa_real;
        }
        if ($request->filled('taxa_porc')) {
            $taxa_porc = str_replace(',', '.', str_replace('.', '', $request->input('taxa_porc')));
            $dca_taxa->taxa_porc = $taxa_porc;
        }
        
        $dca_taxa->save();

        return response()->json([
            'status'=>'ok',
        ]);
    }
    public function edit(Request $require,$id){
        $dca_taxa = DvelopersTaxas::find($id);
        return response()->json($dca_taxa);
    }

    public function update(Request $request){

        $request->except('_token');
        $request->validate([
            'id_formas_pagamento' => 'required',
        ]);

        $id = $request->input('id');

        $dca_taxa = DvelopersTaxas::find($id);

        $dca_taxa->id_formas_pagamento = $request->input('id_formas_pagamento');
        if ($request->filled('taxa_real')) {
            $taxa_real = str_replace(',', '.', str_replace('.', '', $request->input('taxa_real')));
            $dca_taxa->taxa_real = $taxa_real;
        }
        if ($request->filled('taxa_porc')) {
            $taxa_porc = str_replace(',', '.', str_replace('.', '', $request->input('taxa_porc')));
            $dca_taxa->taxa_porc = $taxa_porc;
        }
        
        $dca_taxa->save();

        return response()->json('editado');
    }

    public function delete(Request $request,$id)   {

        $dca_taxa = DvelopersTaxas::find($id);

        $dca_taxa->delete();

        return response(200);
    }
}
