<?php 

class UserController{

    static public function ctrIngresoUsuario(){
        if(isset($_POST["Email"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["Email"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["Password"])){
                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST["Email"];

                $respuesta = User::MdlMostrarUsuarios($tabla, $item, $valor);

                if($respuesta["usuario"] == $_POST["Email"] && $respuesta["password"] == $_POST["Password"]){
                    $_SESSION["iniciarSesion"] = "ok";
                    echo '<script>window.location = "inicio";</script>';
                }else{
                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
                }
            }
        }
    }

    static public function CrearUsuario(){
        if(isset($_POST["nuevoUsuario"])){
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
               preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){
                
                $tabla = "usuarios";
                $datos = array("nombre" => $_POST["nuevoNombre"],
                            "usuario" => $_POST["nuevoUsuario"],
                            "password" => $_POST["nuevoPassword"],
                            "perfil" => $_POST["nuevoPerfil"]);
                $respuesta = User::IngresarUsuario($tabla, $datos);
                if($respuesta == "ok"){
					echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El usuario ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "usuarios";
                            }
                        });
					</script>';
				}
			}else{
				echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "¡El usuario no puede ir vacío o llevar caracteres especiales!"
                    }).then(function(result){
						if(result.value){
							window.location = "usuarios";
						}
					});
				</script>';
			}
        }
    }
}