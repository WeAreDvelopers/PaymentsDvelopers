@extends('layouts.app')

@section('assets')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<!-- CSS Modal Pedido-->
<link href="{{asset('css/modal-pedido.css')}}" rel="stylesheet" />
@endsection

@section('content')

<div>
    @include('admin.dashboard.include._begin-pedidos')
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
   
        <div class="card">
            <div class="card-body">

                <div id="dashboard-Pedidos">
                    @include('admin.dashboard.include._grafico-pedidos')
                </div> 
           </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>


@include('admin.dashboard._script-charts')

@endsection









  