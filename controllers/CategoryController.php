<?php

namespace Controllers;

use Models\Category;

class CategoryController
{
    public static function CrearCategoria()
    {
        if (isset($_POST["nuevaCategoria"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóÁÉÍÓÚ]+$/', $_POST["nuevaCategoria"])) {
                $tabla = "categorias";
                $datos = $_POST["nuevaCategoria"];
                $respuesta = Category::IngresarCategoria($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡La categoría ha sido guardada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "categorias";
                            }
                        });
					</script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "¡La categoría no puede ir vacía o llevar caracteres especiales!"
                    }).then(function(result){
						if(result.value){
							window.location = "categorias";
						}
					});
				</script>';
            }
        }
    }

    public static function MostrarCategorias($item, $valor)
    {
        $tabla = "categorias";
        $respuesta = Category::MostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }

    public static function EditarCategoria()
    {
        if (isset($_POST["editarCategoria"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóÁÉÍÓÚ]+$/', $_POST["editarCategoria"])) {
                $tabla = "categorias";
                $datos = array("categoria" => $_POST["editarCategoria"], "id" => $_POST["idCategoria"]);
                $respuesta = Category::EditarCategoria($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡La categoría ha sido actualizada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "categorias";
                            }
                        });
					</script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "¡La categoría no puede ir vacía o llevar caracteres especiales!"
                    }).then(function(result){
						if(result.value){
							window.location = "categorias";
						}
					});
				</script>';
            }
        }
    }

    public static function BorrarCategoria()
    {
        if (isset($_GET["idCategoria"])) {
            $tabla = "categorias";
            $datos = $_GET["idCategoria"];
            $respuesta = Category::BorrarCategoria($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡La Categoría ha sido borrado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "categorias";
                            }
                        });
					</script>';
            }
        }
    }
}
