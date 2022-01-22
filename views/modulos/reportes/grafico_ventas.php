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
<div class="card bg-gradient-default">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-th mr-1"></i> Grafico de Ventas
        </h3>
    </div>
    <div class="card-body">
        <div class="chart" id="line-chart-ventas" style="height: 250px;"></div>
    </div>
</div>

<script>
var line = new Morris.Line({
    element          : 'line-chart-ventas',
    resize           : true,
    data             : [
        <?php
            if ($noRepetirFechas != null){
                foreach($noRepetirFechas as $key){
                    echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },";
                }
                echo "{y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";
            } else {
            echo "{ y: '0', ventas: '0' }";
            }
        ?>
    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#065AA6'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#03203B',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#065AA6'],
    gridLineColor    : '#03203B',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10
});
</script>