<?php

class SaleController{

    // MostrarVentas
    static public function MostrarVentas($item, $valor){
		$tabla = "ventas";
		$respuesta = Sale::MostrarVentas($tabla, $item, $valor);
		return $respuesta;
	}
}