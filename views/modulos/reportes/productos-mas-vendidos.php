<?php
    $item = null;
    $valor = null;
    $orden = "ventas";
    $productos = ProductController::MostrarProductos($item, $valor, $orden);
    $colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");
    $totalVentas = ProductController::MostrarSumaVentas();
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Productos más Vendidos</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="chart-responsive">
                    <canvas id="pieChart" height="150"></canvas>
                </div>
                <!-- ./chart-responsive -->
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <ul class="chart-legend clearfix">
                    <?php
                        for($i = 0; $i < 10; $i++){
                            echo ' <li><i class="far fa-circle text-'.$colores[$i].'"></i> '.$productos[$i]["descripcion"].'</li>';
                        }
                    ?>
                </ul>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer bg-light p-0">
        <ul class="nav nav-pills flex-column">
            <?php
                for($i = 0; $i <5; $i++){
                echo '<li class="nav-item">
                    <a class="nav-link">
                        <img src="'.$productos[$i]["imagen"].'" class="img-thumbnail" width="60px" style="margin-right:10px"> 
                        '.$productos[$i]["descripcion"].'
                        <span class="float-right text-'.$colores[$i].'">   
                            '.ceil($productos[$i]["ventas"]*100/$totalVentas["total"]).'%
                        </span>
                    </a>
                </li>';
                }
            ?>
        </ul>
    </div>
    <!-- /.footer -->
</div>
<!-- /.card -->

<script>
    //-------------
    // - PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
        labels: [
            <?php
                for ($i=0; $i < 10; $i++) { 
                    echo "'".$productos[$i]["descripcion"]."',";
                } 
            ?>
        ],
        datasets: [
            {
                data: [
                    <?php
                        for ($i=0; $i < 10; $i++) { 
                            echo "".$productos[$i]["ventas"].",";
                        } 
                    ?>
                ],
                backgroundColor: [
                    <?php
                        for ($i=0; $i < 10; $i++) { 
                            echo "'".$colores[$i]."',";
                        } 
                    ?>
                ]
            }
        ]
    }
    var pieOptions = {
        legend: {
            display: false
        }
    }
    // Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    // eslint-disable-next-line no-unused-vars
    var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
    })

    //-----------------
    // - END PIE CHART -
    //-----------------
</script>