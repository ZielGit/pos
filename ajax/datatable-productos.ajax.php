<?php

require_once "../controllers/ProductController.php";
require_once "../models/Product.php";

require_once "../controllers/CategoryController.php";
require_once "../models/Category.php";

class TablaProductos{

    // Mostrar la tabla productos
    public function mostrarTablaProductos(){
        $item = null;
        $valor = null;
        $productos = ProductController::MostrarProductos($item, $valor);
        
        $datosJson = '{
            "data": [';
            for ($i=0; $i < count($productos); $i++) { 
                $imagen = "<img src='".$productos[$i]["imagen"]."' class='img-thumbnail' width='40px'>";

                $item = "id";
                $valor = $productos[$i]["id_categoria"];
                $categorias = CategoryController::MostrarCategorias($item, $valor);

                if ($productos[$i]["stock"] <= 10) {
                    $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
                } else if ($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15) {
                    $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
                } else{
                    $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
                }

                $botones = "<button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button>";
                $datosJson .='[
                    "'.$productos[$i]["id"].'",
                    "'.$imagen.'",
                    "'.$productos[$i]["codigo"].'",
                    "'.$productos[$i]["descripcion"].'",
                    "'.$categorias["categoria"].'",
                    "'.$stock.'",
                    "'.$productos[$i]["precio_compra"].'",
                    "'.$productos[$i]["precio_venta"].'",
                    "'.$productos[$i]["fecha"].'",
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
$activarProductos = new TablaProductos();
$activarProductos->mostrarTablaProductos();