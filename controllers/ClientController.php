<?php

class ClientController{

    // Crear Cliente
    static public function CrearCliente(){
        if (isset($_POST["nuevoCliente"])) {
            
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) && preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoId"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) && 
                preg_match('/^[+()\-0-9 ]+$/', $_POST["nuevoTelefono"]) && preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])) {
                
                $tabla = "clientes";
                $datos = array("nombre"=>$_POST["nuevoCliente"],
                            "documento"=>$_POST["nuevoDocumentoId"],
                            "email"=>$_POST["nuevoEmail"],
                            "telefono"=>$_POST["nuevoTelefono"],
                            "direccion"=>$_POST["nuevaDireccion"],
                            "fecha_nacimiento"=>$_POST["nuevaFechaNacimiento"]);
                $respuesta = Client::IngresarCliente($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El cliente ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.history.back();
                            }
                        });
					</script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "¡El cliente no puede ir vacío o llevar caracteres especiales!"
                    }).then(function(result){
						if(result.value){
							window.location = "clientes";
						}
					});
				</script>';
            }
            
        }
    }

    // Mostrar Usuario
    static public function MostrarClientes($item, $valor){
        $tabla = "clientes";
		$respuesta = Client::MostrarClientes($tabla, $item, $valor);
		return $respuesta;
    }

    // Editar Cliente
    static public function EditarCliente(){
        if (isset($_POST["editarCliente"])) {
            
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) && preg_match('/^[0-9]+$/', $_POST["editarDocumentoId"]) &&
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
                preg_match('/^[+()\-0-9 ]+$/', $_POST["editarTelefono"]) && preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])) {
                
                $tabla = "clientes";
                $datos = array("id"=>$_POST["idCliente"],
                            "nombre"=>$_POST["editarCliente"],
                            "documento"=>$_POST["editarDocumentoId"],
                            "email"=>$_POST["editarEmail"],
                            "telefono"=>$_POST["editarTelefono"],
                            "direccion"=>$_POST["editarDireccion"],
                            "fecha_nacimiento"=>$_POST["editarFechaNacimiento"]);
                $respuesta = Client::EditarCliente($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El cliente ha sido actualizado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "clientes";
                            }
                        });
					</script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "¡El cliente no puede ir vacío o llevar caracteres especiales!"
                    }).then(function(result){
						if(result.value){
							window.location = "clientes";
						}
					});
				</script>';
            }
            
        }
    }

    // Eliminar Cliente
    static public function EliminarCliente(){
        if (isset($_GET["idCliente"])) {
            $tabla ="clientes";
			$datos = $_GET["idCliente"];
			$respuesta = Client::EliminarCliente($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡El cliente ha sido borrado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            window.location = "clientes";
                        }
                    });
                </script>';
            }
        }
    }
}