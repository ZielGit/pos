<?php
    error_reporting(0);

    if (isset($_GET["fechaInicial"])) {
        $fechaInicial = $_GET["fechaInicial"];
        $fechaFinal = $_GET["fechaFinal"];
    } else {
        $fechaInicial = null;
        $fechaFinal = null;
    }

    $respuesta = SaleController::RangoFechasVentas($fechaInicial, $fechaFinal);
    $arrayFechas = array();
    $arrayVentas = array();
    $sumaPagosMes = array();

    foreach ($respuesta as $key => $value) {
        # Capturamos sólo el año y el mes
        $fecha = substr($value["fecha"],0,7);
        # Introducir las fechas en arrayFechas
        array_push($arrayFechas, $fecha);
        # Capturamos las ventas
        $arrayVentas = array($fecha => $value["total"]);
        # Sumamos los pagos que ocurrieron el mismo mes
        foreach ($arrayVentas as $fecha => $value) {
            $sumaPagosMes[$fecha] += $value;
        }
    }

    $noRepetirFechas = array_unique($arrayFechas);
?>

<!-- Grafico de ventas -->
<div class="card bg-gradient-info">
    <div class="card-header border-0">
        <h3 class="card-title">
            <i class="fas fa-th mr-1"></i>
            Grafico de Ventas
        </h3>
    </div>
    <div class="card-body">
        <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
    // Sales graph chart
    var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')

    var salesGraphChartData = {
        labels: [
            <?php
                foreach($noRepetirFechas as $key){
                    echo '"'.$key.'",';
                }
            ?>
        ],
        datasets: [
            {
                label: 'Ventas',
                fill: false,
                borderWidth: 2,
                lineTension: 0,
                spanGaps: true,
                borderColor: '#efefef',
                pointRadius: 3,
                pointHoverRadius: 7,
                pointColor: '#efefef',
                pointBackgroundColor: '#efefef',
                data: [
                    <?php
                        foreach($noRepetirFechas as $key){
                            echo "".$sumaPagosMes[$key].",";
                        }
                    ?>
                ]
            }
        ]
    }

    var salesGraphChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
            ticks: {
                fontColor: '#efefef'
            },
            gridLines: {
                display: false,
                color: '#efefef',
                drawBorder: false
            }
            }],
            yAxes: [{
            ticks: {
                stepSize: 5000,
                fontColor: '#efefef'
            },
            gridLines: {
                display: true,
                color: '#efefef',
                drawBorder: false
            }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    // eslint-disable-next-line no-unused-vars
    var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
        type: 'line',
        data: salesGraphChartData,
        options: salesGraphChartOptions
    })
</script>