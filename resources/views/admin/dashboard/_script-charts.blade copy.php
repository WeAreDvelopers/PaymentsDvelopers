
<!-- BAR SIMPLES -->
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


<!-- LINHAS -->
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




<!-- PIE 3D GOOGLE -->
<script>
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var jsonData = <?php echo json_encode($Produtos); ?>;

        var dataArray = [['Produto', 'Quantidade']];
            for (var i = 0; i < jsonData.labels.length; i++) {
                dataArray.push([jsonData.labels[i], jsonData.qtd[i]]);
        }

        var data = google.visualization.arrayToDataTable (dataArray);

        var options = {
          title: 'Produtos',
          titleTextStyle: { fontSize: 14, color: 'gray' },
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
</script>

<!-- DONUT 3D GOOGLE -->
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
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
</script>



  <!-- BAR HORIZONTAL GOOGLE -->
  <script>
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Year', 'Produtos'],
    ['X-Salada', 38],
    ['Refrigerante', 60],
    ['Pastel', 104],
    ['Agua', 257]
  ]);

  var options = {
    chart: {
      title: 'Pedidos',
      subtitle: 'Evolução Mensal',
    },
    bars: 'horizontal',
    hAxis: {
      ticks: [0, 50, 100, 150, 200, 250, 300], // Define os valores da escala horizontal
      title: 'Quantidade' // Título do eixo horizontal
    },
    vAxis: {
      ticks: [0, 50, 100, 150, 200, 250, 300], // Define os valores da escala vertical
      title: 'Quantidade' // Título do eixo vertical
    }
  };

  var chart = new google.charts.Bar(document.getElementById('barchart_material'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>



<!-- MANY BAR GOOGLE VRTICAL -->
    <script>
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
              title : 'Aqui é um exemplo de multiple Bar vertical',
              vAxis: {title: 'Cups'},
              hAxis: {title: 'Month'},
              seriesType: 'bars',
              series: {5: {type: 'line'}}
            };

            var chart = new google.visualization.ComboChart(document.getElementById('bar_Many'));
            chart.draw(data, options);
          }
    </script>




<script> // Teste BAR
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ['Produtos', 'X-Salada', 'Refrigerante', 'Pastel', 'Agua'],
    ['', 38, 60, 104, 257]
  ]);

  var options = {
    chart: {
      title: 'Pedidos',
      subtitle: 'Evolução Mensal',
    },
    bars: 'horizontal',
    vAxis: {
      ticks: [0, 50, 100, 150, 200, 250, 300], // Define os valores da escala vertical
      title: 'Quantidade' // Título do eixo vertical
    },
    hAxis: {
      title: 'Produtos' // Título do eixo horizontal
    },
    height: 400,
    width: 600,
    legend: { position: 'top', maxLines: 3 },
    bar: { groupWidth: '75%' }
  };

  var chart = new google.charts.Bar(document.getElementById('teste_bar'));

  chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>

