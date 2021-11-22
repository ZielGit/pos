<?php

require_once "../controllers/CategoryController.php";
require_once "../models/Category.php";

class AjaxCategorias{
    // Editar Categoria
    public $idCategoria;

    public function ajaxEditarCategoria(){
        $item = "id";
        $valor = $this->idCategoria;
        $respuesta = CategoryController::MostrarCategorias($item, $valor);
        echo json_encode($respuesta);
    }
}

// Editar Categoría
if (isset($_POST["idCategoria"])) {
    $categoria = new AjaxCategorias();
    $categoria->idCategoria = $_POST["idCategoria"];
    $categoria->ajaxEditarCategoria();
}