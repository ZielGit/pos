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
        $orden = "id";
        $respuesta = ProductController::MostrarProductos($item, $valor, $orden);
        echo json_encode($respuesta);
    }

    // Editar Producto
    public $idProducto;
    public $traerProductos;
    public $nombreProducto;

    public function ajaxEditarProducto(){
        if ($this->traerProductos == "ok") {
            $item = null;
            $valor = null;
            $orden = "id";
            $respuesta = ProductController::MostrarProductos($item, $valor, $orden);
            echo json_encode($respuesta);
        } else if ($this->nombreProducto != "") {
            $item = "descripcion";
            $valor = $this->nombreProducto;
            $orden = "id";
            $respuesta = ProductController::MostrarProductos($item, $valor, $orden);
            echo json_encode($respuesta);
        } else {
            $item = "id";
            $valor = $this->idProducto;
            $orden = "id";
            $respuesta = ProductController::MostrarProductos($item, $valor, $orden);
            echo json_encode($respuesta);
        }
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

// Traer Producto
if(isset($_POST["traerProductos"])){
    $traerProductos = new AjaxProductos();
    $traerProductos -> traerProductos = $_POST["traerProductos"];
    $traerProductos -> ajaxEditarProducto();
}

// Seleccionar Producto
if(isset($_POST["nombreProducto"])){
    $traerProductos = new AjaxProductos();
    $traerProductos -> nombreProducto = $_POST["nombreProducto"];
    $traerProductos -> ajaxEditarProducto();
}