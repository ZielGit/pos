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
				$orden = "id";
				$traerProducto = Product::MostrarProductos($tablaProductos, $item, $valor, $orden);
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
			$item1b = "ultima_compra";
			date_default_timezone_set('America/Lima');
			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;
			$fechaCliente = Client::ActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);
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

	// Editar Venta
	static public function EditarVenta(){
		if (isset($_POST["editarVenta"])) {
			// Formatear tabla de productos y la de clientes
			$tabla = "ventas";
			$item = "codigo";
			$valor = $_POST["editarVenta"];
			$traerVenta = Sale::MostrarVentas($tabla, $item, $valor);
			// Revisar si viene productos editados
			if($_POST["listaProductos"] == ""){
				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;
			}else{
				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if ($cambioProducto) {
				$productos =  json_decode($traerVenta["productos"], true);
				$totalProductosComprados = array();
				foreach ($productos as $key => $value) {
					array_push($totalProductosComprados, $value["cantidad"]);
					$tablaProductos = "productos";
					$item = "id";
					$valor = $value["id"];
					$orden = "id";
					$traerProducto = Product::MostrarProductos($tablaProductos, $item, $valor, $orden);
					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];
					$nuevasVentas = Product::ActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);
					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];
					$nuevoStock = Product::ActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
				}
				$tablaClientes = "clientes";
				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarCliente"];
				$traerCliente = Client::MostrarClientes($tablaClientes, $itemCliente, $valorCliente);
				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);
				$comprasCliente = Client::ActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);
				// Actualizar las compras del cliente y reducir el stock y aumentar las ventas de los productos
				$listaProductos_2 = json_decode($listaProductos, true);
				$totalProductosComprados_2 = array();
				foreach ($listaProductos_2 as $key => $value) {
					array_push($totalProductosComprados_2, $value["cantidad"]);
					$tablaProductos_2 = "productos";
					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";
					$traerProducto_2 = Product::MostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);
					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];
					$nuevasVentas_2 = Product::ActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);
					$item1b_2 = "stock";
					$valor1b_2 = $value["stock"];
					$nuevoStock_2 = Product::ActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);
				}
				$tablaClientes_2 = "clientes";
				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];
				$traerCliente_2 = Client::MostrarClientes($tablaClientes_2, $item_2, $valor_2);
				$item1a_2 = "compras";
				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];
				$comprasCliente_2 = Client::ActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);
				$item1b_2 = "ultima_compra";
				date_default_timezone_set('America/Lima');
				$fecha = date('Y-m-d');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;
				$fechaCliente_2 = Client::ActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);
				
				// Guardar cambios de la compra
				$datos = array(
					"id_vendedor"	=>$_POST["idVendedor"],
					"id_cliente"	=>$_POST["seleccionarCliente"],
					"codigo"		=>$_POST["editarVenta"],
					"productos"		=>$listaProductos,
					"impuesto"		=>$_POST["nuevoPrecioImpuesto"],
					"neto"			=>$_POST["nuevoPrecioNeto"],
					"total"			=>$_POST["totalVenta"],
					"metodo_pago"	=>$_POST["listaMetodoPago"]
				);
				$respuesta = Sale::EditarVenta($tabla, $datos);
				if ($respuesta == "ok") {
					echo '<script>
						localStorage.removeItem("rango");
						Swal.fire({
							icon: "success",
							title: "La venta ha sido editada correctamente",
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

	// Eliminar Venta
	static public function EliminarVenta(){
		if (isset($_GET["idVenta"])) {
			$tabla = "ventas";
			$item = "id";
			$valor = $_GET["idVenta"];
			$traerVenta = Sale::MostrarVentas($tabla, $item, $valor);
			// Actualizar fecha útima compra
			$tablaClientes = "clientes";
			$itemVentas = null;
			$valorVentas = null;
			$traerVentas = Sale::MostrarVentas($tabla, $itemVentas, $valorVentas);
			$guardarFechas = array();
			foreach ($traerVentas as $key => $value) {
				if($value["id_cliente"] == $traerVenta["id_cliente"]){
					array_push($guardarFechas, $value["fecha"]);
				}
			}
			if(count($guardarFechas) > 1){
				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){
					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];
					$comprasCliente = Client::ActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
				}else{
					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];
					$comprasCliente = Client::ActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
				}
			}else{
				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];
				$comprasCliente = Client::ActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
			}
			// Formatear tabla de productos y la de clientes
			$productos =  json_decode($traerVenta["productos"], true);
			$totalProductosComprados = array();
			foreach ($productos as $key => $value) {
				array_push($totalProductosComprados, $value["cantidad"]);
				$tablaProductos = "productos";
				$item = "id";
				$valor = $value["id"];
				$orden = "id";
				$traerProducto = Product::MostrarProductos($tablaProductos, $item, $valor,$orden);
				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];
				$nuevasVentas = Product::ActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);
				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];
				$nuevoStock = Product::ActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
			}
			$tablaClientes = "clientes";
			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];
			$traerCliente = Client::MostrarClientes($tablaClientes, $itemCliente, $valorCliente);
			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);
			$comprasCliente = Client::ActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);
			
			// Eliminar Venta
			$respuesta = Sale::EliminarVenta($tabla, $_GET["idVenta"]);
			if ($respuesta == "ok") {
				echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡El venta ha sido eliminado correctamente!",
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

	// Rango de Fechas
	static public function RangoFechasVentas($fechaInicial, $fechaFinal){
		$tabla = "ventas";
		$respuesta = Sale::RangoFechasVentas($tabla, $fechaInicial, $fechaFinal);
		return $respuesta;
	}

	// Descargar Excel
	public function DescargarReporte(){
		if (isset($_GET["reporte"])) {
			$tabla = "ventas";
			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){
				$ventas = Sale::RangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
			}else{
				$item = null;
				$valor = null;
				$ventas = Sale::MostrarVentas($tabla, $item, $valor);
			}

			// Creamos el archivo de excel
			$Name = $_GET["reporte"].'.xls';
			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");
			echo utf8_decode(
				"<table border='0'> 
				<tr> 
				<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
				<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
				<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
				<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
				<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
				<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
				<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
				<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
				<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
				<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
				</tr>"
			);
			foreach ($ventas as $row => $item){
				$cliente = ClientController::MostrarClientes("id", $item["id_cliente"]);
				$vendedor = UserController::MostrarUsuario("id", $item["id_vendedor"]);
			 	echo utf8_decode(
					"<tr>
			 		<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 		<td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
			 		<td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
			 		<td style='border:1px solid #eee;'>"
				);
			 	$productos =  json_decode($item["productos"], true);
			 	foreach ($productos as $key => $valueProductos) {	
			 			echo utf8_decode($valueProductos["cantidad"]."<br>");
			 	}
			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
		 		foreach ($productos as $key => $valueProductos) {	
		 			echo utf8_decode($valueProductos["descripcion"]."<br>");
		 		}
		 		echo utf8_decode(
					"</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
					<td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
					<td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
					<td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
					<td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
		 			</tr>"
				);
			}
			echo "</table>";
		}
	}

	// Suma Total de Ventas
	static public function SumaTotalVentas(){
		$tabla = "ventas";
		$respuesta = Sale::SumaTotalVentas($tabla);
		return $respuesta;
	}
}