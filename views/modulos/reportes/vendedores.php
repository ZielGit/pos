<?php

$item = null;
$valoe = null;
$ventas = SaleController::MostrarVentas($item, $valor);
$usuarios = UserController::MostrarUsuario($item, $valor);
$arrayVendedores = array();
$arraylistaVendedores = array();

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

<!-- Vendedores -->
<div class="card card-success card-outline">
    <div class="card-header">
        <h3 class="card-title">Vendedores</h3>
    </div>
    
    <div class="card-body pad table-responsive">
        <div class="chart" id="bar-chart1" style="height: 300px;"></div>
    </div>
    <!-- /.card -->
</div>

<script>
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [
  <?php
    foreach($noRepetirNombres as $value){
      echo "{y: '".$value."', a: '".$sumaTotalVendedores[$value]."'},";
    }
  ?>
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '$',
  hideHover: 'auto'
});
</script>