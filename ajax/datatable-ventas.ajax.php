<?php

require_once "../controllers/ProductController.php";
require_once "../models/Product.php";

class TablaProductosVentas{
    
    // Mostrar la tabla productos
    public function mostrarTablaProductosVentas(){
        $item = null;
    	$valor = null;
  		$productos = ProductController::MostrarProductos($item, $valor);

        if(count($productos) == 0){
            echo '{"data": []}';
            return;
        }

        $datosJson = '{
            "data": [';

            for ($i=0; $i < count($productos); $i++) { 
                // Traemos la Imagen
                $imagen = "<img src='".$productos[$i]["imagen"]."' class='img-thumbnail' width='40px'>";

                if ($productos[$i]["stock"] <= 10) {
                    $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
                } else if ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15) {
                    $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
                } else{
                    $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
                }

                // Traemos las acciones
                $botones = "<button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</i></button>";
                $datosJson .='[
					"'.$productos[$i]["id"].'",
					"'.$imagen.'",
					"'.$productos[$i]["codigo"].'",
					"'.$productos[$i]["descripcion"].'",
					"'.$stock.'",
					"'.$botones.'"
				],';
            }
            $datosJson = substr($datosJson, 0, -1);
            $datosJson .= ']
        }';
        echo $datosJson;
    }
}

// Activar Tabla Productos
$activarProductosVentas = new TablaProductosVentas();
$activarProductosVentas -> mostrarTablaProductosVentas();