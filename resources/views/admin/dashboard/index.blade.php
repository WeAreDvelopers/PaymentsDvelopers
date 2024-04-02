@extends('layouts.app')

@section('assets')

@endsection

@section('content')
@if($empresas)
<div class="card">
    <div class="card-body">
        <label for="">Empresas</label>
       
        <select name="" id="empresa" class="form-select">
            <option value="">Selecione Empresa:</option>
            @foreach($empresas as $k => $empre)
            <option value="{{$empre->id}}">{{$empre->nome}}</option>
            @endforeach
        </select>
    </div>
</div>
@endif

<div class="" id="viewempresa">
    @include('admin.dashboard._dash')
</div>

@endsection


@section('scripts')

<script>
var id = $('#idinput').val();
console.log('id=' + id);
function ultimosPagamentos() {
    var id = $('#idinput').val();
    var url = '{{ route("admin.dash.ultimosPagamentos") }}/' + id;
    $.get(url, function(data) {
        $("#listaPagamentos").html(data);
    });
}

function graficoCategorias() {
    var id = $('#idinput').val();
    $.ajax({
        url: '{{route("admin.dash.graficoCategorias")}}/' + id,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var labels = data.map(item => item.grupos);
            var valores = data.map(item => item.categorias);

            var ctx = document.getElementById('graficoPizza').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: valores,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                }
            });
        }
    });
}

function graficoProdutos() {
    var id = $('#idinput').val();
    $.ajax({
        url: '{{route("admin.dash.graficoProdutos")}}/' + id,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var labels = data.map(item => item.categorias);
            var valores = data.map(item => item.produtos);

            var ctx = document.getElementById('graficoPizza2').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: valores,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                }
            });
        }
    });
}

function graficoPagamentos() {
    var id = $('#idinput').val();
    $.ajax({
        url: '{{route("admin.dash.graficoPagamentos")}}/' + id,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var labels = data.map(item => item.formas_pagamentos);
            var valores = data.map(item => item.pagamentos);

            var ctx = document.getElementById('graficoPizza3').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: valores,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                        ],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                }
            });
        }
    });
}

function graficoValores() {
    var id = $('#idinput').val();
    $.ajax({
        url: '{{route("admin.dash.graficoValores")}}/' + id,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var labels = data.map(item => item.formas_pagamentos);
            var valores = data.map(item => item.valores);

            var ctx = document.getElementById('graficoPizza4').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: valores,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                        ],
                    }],
                },
                options: {
    showAllTooltips: true
}
            });
        }
    });
}

setInterval(function() {
    ultimosPagamentos();
    graficoProdutos();
    graficoCategorias();
    graficoPagamentos();
    graficoValores();
}, 3000);

window.onload = function () {
    ultimosPagamentos();
    graficoProdutos();
    graficoCategorias();
    graficoPagamentos();
    graficoValores();
    
};


$("body").on("change", "#empresa", function(e) {
    var idempresa = this.value;

    
        var url = '{{ route("admin.dash.buscar", ["id" => ":id"]) }}';
        url = url.replace(':id', idempresa);

        $.get(url, function(data) {
            $("#viewempresa").html(data);
            ultimosPagamentos();
            graficoProdutos();
            graficoCategorias();
            graficoPagamentos();
            graficoValores();
        });
});

   
</script>
@endsection