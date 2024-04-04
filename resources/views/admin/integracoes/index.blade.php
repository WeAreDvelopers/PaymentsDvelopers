@extends('layouts.app')

@section('assets')

@endsection

@section('content')
<div class="row mt-5">
    @foreach($listaIntegracoes as $k => $v)
    <div class="col-sm-4 col-12">
        <div class="card">
            <div class="card-header text-center">
              {!!status(empresa()->checkIntegracao($v)->status)!!}
           
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col">
                       <img src="{{asset('img/integracoes/'.$v.'.png')}}" class="w-100" alt="">
                    </div>
              
                  
                </div>
               
            </div>
            <div class="card-footer">
            <div class="row">
                    <div class="col text-center">
                        <a href="{{route('admin.integracoes.configuracoes',['slug'=>$v])}}" class="btn btn-sm btn-primary">Configurar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
   
</div>

@endsection
