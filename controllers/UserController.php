<?php 

class UserController{

    static public function ctrIngresoUsuario(){
        if(isset($_POST["Email"])){
            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["Email"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["Password"])){
                $encriptar = crypt($_POST["Password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST["Email"];

                $respuesta = User::MdlMostrarUsuarios($tabla, $item, $valor);

                if($respuesta["usuario"] == $_POST["Email"] && $respuesta["password"] == $encriptar){
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
                
                // validar imagen
                $ruta = "";
                if (isset($_FILES["nuevaFoto"]["tmp_name"])){
                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                    $nuevoAncho = 500;
					$nuevoAlto = 500;
                    // Crear el directorio
                    $directorio = "views/img/users/".$_POST["nuevoUsuario"];
                    mkdir($directorio, 0755);
                    // De acuerdo al tipo de imagen aplicamos las funciones por defecto de php
                    if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "views/img/users/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
                    }

                    if($_FILES["nuevaFoto"]["type"] == "image/png"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "views/img/users/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";
                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                $datos = array("nombre" => $_POST["nuevoNombre"],
                            "usuario"   => $_POST["nuevoUsuario"],
                            "password"  => $encriptar,
                            "perfil"    => $_POST["nuevoPerfil"],
                            "foto"      => $ruta);
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