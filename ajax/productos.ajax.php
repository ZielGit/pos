<?php

require_once "../controllers/ProductController.php";
require_once "../models/Product.php";

require_once "../controllers/CategoryController.php";
require_once "../models/Category.php";

class AjaxProductos{

    // Generar código a partir de id categoria
    public $idCategoria;

    public function ajaxCrearCodigoProducto(){
        $item = "id_categoria";
        $valor = $this->idCategoria;
        $respuesta = ProductController::MostrarProductos($item, $valor);
        echo json_encode($respuesta);
    }
}

// Generar código a partir de id categoria
if(isset($_POST["idCategoria"])){
    $codigoProducto = new AjaxProductos();
    $codigoProducto -> idCategoria = $_POST["idCategoria"];
    $codigoProducto -> ajaxCrearCodigoProducto();
  }