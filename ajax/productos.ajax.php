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

    // Editar Producto
    public $idProducto;

    public function ajaxEditarProducto(){
        $item = "id";
        $valor = $this->idProducto;
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

// Editar Producto
if(isset($_POST["idProducto"])){
    $editarProducto = new AjaxProductos();
    $editarProducto -> idProducto = $_POST["idProducto"];
    $editarProducto -> ajaxEditarProducto();
}