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
                
                // Validar imagen
                $ruta = "views/img/products/default/anonymous.png";   

                if (isset($_FILES["nuevaImagen"]["tmp_name"])){
                    list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
                    $nuevoAncho = 500;
					$nuevoAlto = 500;
                    // Crear el directorio
                    $directorio = "views/img/products/".$_POST["nuevoCodigo"];
                    mkdir($directorio, 0755);
                    // De acuerdo al tipo de imagen aplicamos las funciones por defecto de php
                    if($_FILES["nuevaImagen"]["type"] == "image/jpeg"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "views/img/products/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
                    }

                    if($_FILES["nuevaImagen"]["type"] == "image/png"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "views/img/products/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
                    }
                }
                
                $tabla = "productos";
                $datos = array("id_categoria" => $_POST["nuevaCategoria"],
							   "codigo" => $_POST["nuevoCodigo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "stock" => $_POST["nuevoStock"],
							   "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "precio_venta" => $_POST["nuevoPrecioVenta"],
							   "imagen" => $ruta);
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