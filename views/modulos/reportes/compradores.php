<?php
    $item = null;
    $valor = null;
    $ventas = SaleController::MostrarVentas($item, $valor);
    $clientes = ClientController::MostrarClientes($item, $valor);
    $arrayClientes = array();
    $arraylistaClientes = array();
    $sumaTotalClientes = array();

    foreach ($ventas as $key => $valueVentas) {
        foreach ($clientes as $key => $valueClientes) {
            if($valueClientes["id"] == $valueVentas["id_cliente"]){
                #Capturamos los Clientes en un array
                array_push($arrayClientes, $valueClientes["nombre"]);
                #Capturamos las nombres y los valores netos en un mismo array
                $arraylistaClientes = array($valueClientes["nombre"] => $valueVentas["neto"]);

                #Sumamos los netos de cada cliente
                foreach ($arraylistaClientes as $key => $value) {
                    $sumaTotalClientes[$key] += $value;
                }
            }
        }
    }

    #Evitamos repetir nombre
    $noRepetirNombres = array_unique($arrayClientes);
?>

<!-- BAR CHART - Compradores -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Compradores</h3>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="barChartCompradores" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChartCompradores').get(0).getContext('2d')
    var barChartData = {
        labels: [
        <?php
            foreach ($noRepetirNombres as $value) {
                echo "'".$value."',";
            }
        ?>
        ],
        datasets: [{
        label: 'Compras',
        data: [
            <?php
                foreach ($noRepetirNombres as $value) {
                    echo "".$sumaTotalClientes[$value].",";
                }
            ?>
        ],
        backgroundColor: 'rgba(0, 123, 255, 0.8)',
        borderColor: 'rgba(12, 12, 143, 1)',
        borderWidth: 1
        }]
    }

    var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
</script>