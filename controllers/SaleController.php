<?php

class SaleController{

    // MostrarVentas
    static public function MostrarVentas($item, $valor){
		$tabla = "ventas";
		$respuesta = Sale::MostrarVentas($tabla, $item, $valor);
		return $respuesta;
	}

	// Crear Venta
	static public function CrearVenta(){
		if (isset($_POST["nuevaVenta"])) {
			// Actualizar las compras del cliente, reducir el stock y aumentar las ventas de los productos 
			$listaProductos = json_decode($_POST["listaProductos"], true);
			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {
				array_push($totalProductosComprados, $value["cantidad"]);
				$tablaProductos = "productos";
				$item = "id";
				$valor = $value["id"];
				$traerProducto = Product::MostrarProductos($tablaProductos, $item, $valor);
				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];
				$nuevasVentas = Product::ActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);
				$item1b = "stock";
				$valor1b = $value["stock"];
				$nuevoStock = Product::ActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
			}

			$tablaClientes = "clientes";
			$item = "id";
			$valor = $_POST["seleccionarCliente"];
			$traerCliente = Client::MostrarClientes($tablaClientes, $item, $valor);
			$item1a = "compras";
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];
			$comprasCliente = Client::ActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);
			// $item1b = "ultima_compra";
			// date_default_timezone_set('America/Lima');
			// $fecha = date('Y-m-d');
			// $hora = date('H:i:s');
			// $valor1b = $fecha.' '.$hora;
			// $fechaCliente = Client::ActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);
			// Guardar la venta
			$tabla = "ventas";
			$datos = array(
				"id_vendedor"	=>$_POST["idVendedor"],
				"id_cliente"	=>$_POST["seleccionarCliente"],
				"codigo"		=>$_POST["nuevaVenta"],
				"productos"		=>$_POST["listaProductos"],
				"impuesto"		=>$_POST["nuevoPrecioImpuesto"],
				"neto"			=>$_POST["nuevoPrecioNeto"],
				"total"			=>$_POST["totalVenta"],
				"metodo_pago"	=>$_POST["listaMetodoPago"]
			);
			$respuesta = Sale::IngresarVenta($tabla, $datos);
			if ($respuesta == "ok") {
				echo '<script>
					localStorage.removeItem("rango");
					Swal.fire({
						icon: "success",
						title: "La venta ha sido guardada correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "ventas";
						}
					});
				</script>';
			}
		}
	}
}