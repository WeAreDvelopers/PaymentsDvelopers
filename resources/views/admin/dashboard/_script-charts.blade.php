

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



<!-- DONUT 3D GOOGLE -->
<script>
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var jsonData = <?php echo json_encode($ProdutosDonut); ?>;

        var dataArray = [['Produto', 'Quantidade']];
            for (var i = 0; i < jsonData.labels.length; i++) {
                dataArray.push([jsonData.labels[i], jsonData.qtd[i]]);
        }

        var data = google.visualization.arrayToDataTable (dataArray);

        var options = {
          title: 'Venda por Produto',
          titleTextStyle: { fontSize: 18, color: 'black' },
          pieHole: 0.4,
          legend: {position: 'bottom', textStyle: {color: 'blue', fontSize: 16}},
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
</script>

<!-- LINHAS - Google multiple -->
<script>
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Mês');

    @foreach ($Produtos['datasets'] as $dataset)
      data.addColumn('number', '{{ $dataset['label'] }}');
    @endforeach

    var rows = [];
    @foreach ($Produtos['labels'] as $monthIndex => $month)
      var row = ['{{ $month }}'];
      @foreach ($Produtos['datasets'] as $dataset)
        row.push({{ $dataset['data'][$monthIndex] }});
      @endforeach
      rows.push(row);
    @endforeach

    data.addRows(rows);

    var options = {
      title: 'Evolução',
      titleTextStyle: { fontSize: 20, color: 'black' },
      curveType: 'none',
      legend: { position: 'bottom' },
      hAxis: {
        title: '',
        slantedText: true,
        slantedTextAngle: 45,
        gridlines: { color: '#ccc', count: {{ count($Produtos['labels']) }} }
      },
      vAxis: {
        title: 'Vendas',
        gridlines: { color: '#ccc', count: 10 }
      },
      series: {
        @foreach ($Produtos['datasets'] as $index => $dataset)
          {{ $index }}: { color: '{{ $dataset['color'] }}' },
        @endforeach
      }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    chart.draw(data, options);
  }
</script>
