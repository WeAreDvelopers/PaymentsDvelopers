@extends('layouts.pagamento')

@section('pre-assets')

@endsection

@section('content')

<body>

    <header class="header-pagamento">
        <div class="row justify-content-center">
            <div class="col-auto text-center"> 
                @if($pedido->empresa->media)
                    <img src="{{$pedido->empresa->media->fullpatch()}}" >
               
 
                @endif
        </div>
        </div>
       
    </header>

    <div class="container d-flex justify-content-center" id="" class=" ">
        <div class="card col-sm-6 col-12 bg-light">
            <div class="card-body">
                <div class="row p-sm-5 p-3">
                    <div class="col text-center">
                            <i class="fa-regular fa-circle-check text-success" style="font-size: 5em;"></i>
                        <h2 class="text-success">Sucesso!</h2>
                        <h4>Número do Pedido: <span class="text-uppercase">{{$pedido->numero_pedido}}</span></h4>
                        <p>Enviamos um e-mail para você com todos os dados referente ao seu pedido.</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col text-center">
                        <strong>Dados da Empresa:</strong>
                        <p>
                            {{$pedido->empresa->nome}}<Br>
                            CNPJ: {{$pedido->empresa->cnpj}}<br>
                            Telefone: {{$pedido->empresa->telefone_contato}}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
   
</body>



@endsection

@section('scripts')
<script>







</script>

@endsection