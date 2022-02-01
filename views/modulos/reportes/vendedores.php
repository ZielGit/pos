<?php
  $item = null;
  $valoe = null;
  $ventas = SaleController::MostrarVentas($item, $valor);
  $usuarios = UserController::MostrarUsuario($item, $valor);
  $arrayVendedores = array();
  $arraylistaVendedores = array();
  $sumaTotalVendedores = array();

  foreach ($ventas as $key => $valueVentas) {
    foreach ($usuarios as $key => $valueUsuarios) {
      if($valueUsuarios["id"] == $valueVentas["id_vendedor"]){
          #Capturamos los vendedores en un array
          array_push($arrayVendedores, $valueUsuarios["nombre"]);
          #Capturamos las nombres y los valores netos en un mismo array
          $arraylistaVendedores = array($valueUsuarios["nombre"] => $valueVentas["neto"]);
          
          #Sumamos los netos de cada vendedor
          foreach ($arraylistaVendedores as $key => $value) {
              $sumaTotalVendedores[$key] += $value;
          }
      }
    }
  }

  #Evitamos repetir nombre
  $noRepetirNombres = array_unique($arrayVendedores);
?>

<!-- BAR CHART - Vendedores -->
<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Vendedores</h3>
  </div>
  <div class="card-body">
    <div class="chart">
      <canvas id="barChartVendedores" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
  //-------------
  //- BAR CHART -
  //-------------
  var barChartCanvas = $('#barChartVendedores').get(0).getContext('2d')
  var barChartData = {
    labels: [
      <?php
        foreach ($noRepetirNombres as $value) {
          echo "'".$value."',";
        }
      ?>
    ],
    datasets: [{
      label: 'Ventas',
      data: [
        <?php
          foreach ($noRepetirNombres as $value) {
            echo "".$sumaTotalVendedores[$value].",";
          }
        ?>
      ],
      backgroundColor: 'rgba(40, 167, 69, 0.8)',
      borderColor: 'rgba(12, 143, 12, 1)',
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