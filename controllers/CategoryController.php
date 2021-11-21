<?php

class CategoryController{

    // Crear Categoría
    static public function CrearCategoria(){
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
            }else {
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

    // Mostrar Categorias
    static public function MostrarCategorias($item, $valor){
        $tabla = "categorias";
        $respuesta = Category::MostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }
}