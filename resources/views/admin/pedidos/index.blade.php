@extends('layouts.app')

@section('assets')

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<!-- CSS Modal Pedido-->
<link href="{{asset('css/modal-pedido.css')}}" rel="stylesheet" />


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

<script>
        var ctx = document.getElementById('barChart').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($clientes['labels']),
                    datasets: [{
                        label: 'Clientes',
                        data: @json($clientes['qtd']),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
        });
</script>

<script>
        var ctx2 = document.getElementById('doughnuChart').getContext('2d');
        var myChart = new Chart(ctx2, {
            type:'doughnut',
            data: {
                labels: @json($produtos['labels']),

                datasets: [{
                    
                    data: @json($produtos['qtd']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });
</script>

<script>
        var ctx3 = document.getElementById('lineChart').getContext('2d');
        var myChart = new Chart(ctx3, {
            type: 'line',
            data: {

                labels: @json($vendas['labels']),

                datasets: [{

                    label: 'Vendas',
                    data: @json($vendas['qtd']),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false 

                    },{
                    
                    label: 'Vendas 1',
                    data: @json($vendas1['qtd']),
                    borderColor:'rgba(255, 0, 0, 1)',
                    backgroundColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 1,
                    fill: false 
                    
                }],

            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
</script>

<script>
        
      // Chart.register(ChartDataLabels);
        
        var ctx4 = document.getElementById('barHorizonChart').getContext('2d');
        var chart = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: @json($produtosBar['labels']),
                datasets: [{
                    label: 'Produtos',
                    data: @json($produtosBar['qtd']),
                    backgroundColor: ['rgba(255, 0, 0, 1)', 'rgba(128, 0, 128, 1)', 'rgba(75, 192, 192, 0.6)', 'rgba(0, 255, 0, 1)','rgba(255, 192, 203, 1)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(128, 0, 128, 1)', 'rgba(75, 192, 192, 1)', 'rgba(0, 255, 0, 1)', 'rgba(255, 192, 203, 1)'],
                    borderWidth: 1,
                   
                }]
            },
            options: {
                indexAxis: 'y', //set the horizontal appearence
                plugins: {
                  // Change options for ALL labels of THIS CHART
                  datalabels: {
                    color: 'black',
                    font: {
                      weight: 'bold', // You can customize the font style
                    },
                    align:'end',
                    anchor: 'end',
                    display: true, // Display data labels on the bars
                  }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10 // Adjust the step size of the y-axis ticks as needed
                        }
                    }
                }
            }
        });
</script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
          ['2004/05',  165,      938,         522,             998,           450,      614.6],
          ['2005/06',  135,      1120,        599,             1268,          288,      682],
          ['2006/07',  157,      1167,        587,             807,           397,      623],
          ['2007/08',  139,      1110,        615,             968,           215,      609.4],
          ['2008/09',  136,      691,         629,             1026,          366,      569.6]
        ]);

        var options = {
          title : 'Monthly Coffee Production by Country',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('bar_Many'));
        chart.draw(data, options);
      }
</script>

<!-- PIE 3D GOOGLE -->
<script>
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>


@endsection







  