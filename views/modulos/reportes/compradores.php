<?php

$item = null;
$valor = null;
$ventas = SaleController::MostrarVentas($item, $valor);
$clientes = ClientController::MostrarClientes($item, $valor);
$arrayClientes = array();
$arraylistaClientes = array();

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

<!-- Compradores -->
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Compradores</h3>
    </div>
    
    <div class="card-body pad table-responsive">
        <div class="chart" id="bar-chart2" style="height: 300px;"></div>
    </div>
    <!-- /.card -->
</div>

<script>
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart2',
  resize: true,
  data: [
     <?php
    
    foreach($noRepetirNombres as $value){

      echo "{y: '".$value."', a: '".$sumaTotalClientes[$value]."'},";

    }

  ?>
  ],
  barColors: ['#f6a'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['ventas'],
  preUnits: '$',
  hideHover: 'auto'
});
</script>