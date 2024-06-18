<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leads;
use Illuminate\Support\Facades\Auth;

class LeadsController extends Controller
{
   

    public function index(Request $request)
    {

      
 

        $leads = Leads::filterEmpresa()->get();
    
        return view('admin.leads.index', compact('leads'));
        
    }

// DELETAR
    public function delete(Request $request,$id)   {

        $lead = Leads::find($id);
        $lead->delete();

        return response()->json(['status'=>'ok'],200);
    }
}
