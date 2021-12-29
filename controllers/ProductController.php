<?php

class ProductController{

    // Mostrar Productos
    static public function MostrarProductos($item, $valor){
        $tabla = "productos";
        $respuesta = Product::MostrarProductos($tabla, $item, $valor);
        return $respuesta;
    }

    // Crear Producto
    static public function CrearProducto(){
        if(isset($_POST["nuevaDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) && preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) && preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){
                
                $ruta = "views/img/products/default/anonymous.png";   
                
                $tabla = "productos";
                $datos = array("id_categoria"   => $_POST["nuevaCategoria"],
							"codigo"            => $_POST["nuevoCodigo"],
							"descripcion"       => $_POST["nuevaDescripcion"],
							"stock"             => $_POST["nuevoStock"],
							"precio_compra"     => $_POST["nuevoPrecioCompra"],
							"precio_venta"      => $_POST["nuevoPrecioVenta"],
							"imagen"            => $ruta);
                $respuesta = Product::IngresarProducto($tabla, $datos);
                if($respuesta == "ok"){
					echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El producto ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "productos";
                            }
                        });
					</script>';
				}
            }else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "¡El producto no puede ir vacío o llevar caracteres especiales!"
                    }).then(function(result){
						if(result.value){
							window.location = "productos";
						}
					});
				</script>';
            }
        }
    }
}