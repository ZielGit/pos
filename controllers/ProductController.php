<?php

class ProductController{

    // Mostrar Productos
    static public function MostrarProductos($item, $valor){
        $tabla = "productos";
        $respuesta = Product::MostrarProductos($tabla, $item, $valor);
        return $respuesta;
    }
}