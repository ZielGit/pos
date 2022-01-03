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

    // Editar Producto
    static public function EditarProducto(){
        if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) && preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) && preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){
                
                // Validar imagen
                $ruta = $_POST["imagenActual"];   

                if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){
                    list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);
                    $nuevoAncho = 500;
					$nuevoAlto = 500;
                    // Crear el directorio
                    $directorio = "views/img/products/".$_POST["editarCodigo"];
                    // Verificamos si la imagen existe en la bd
                    if (!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "views/img/products/default/anonymous.png") {
                        unlink($_POST["imagenActual"]);
                    } else {
                        mkdir($directorio, 0755);
                    }
                    // De acuerdo al tipo de imagen aplicamos las funciones por defecto de php
                    if($_FILES["editarImagen"]["type"] == "image/jpeg"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "views/img/products/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
                    }

                    if($_FILES["editarImagen"]["type"] == "image/png"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "views/img/products/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
                    }
                }
                
                $tabla = "productos";
                $datos = array("id_categoria" => $_POST["editarCategoria"],
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "stock" => $_POST["editarStock"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   "imagen" => $ruta);
                $respuesta = Product::EditarProducto($tabla, $datos);
                if($respuesta == "ok"){
					echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El producto ha sido actualizado correctamente!",
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

    // Eliminar Producto
    static public function EliminarProducto(){
        if(isset($_GET["idProducto"])){
            $tabla ="productos";
			$datos = $_GET["idProducto"];
            if($_GET["imagen"] != "" && $_GET["imagen"] != "views/img/products/default/anonymous.png"){
				unlink($_GET["imagen"]);
				rmdir('views/img/products/'.$_GET["codigo"]);
			}
            $respuesta = Product::EliminarProducto($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡El producto ha sido eliminado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
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