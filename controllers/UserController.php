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
                    if ($respuesta["estado"] == 1) {
                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id"] = $respuesta["id"];
                        $_SESSION["nombre"] = $respuesta["nombre"];
                        $_SESSION["usuario"] = $respuesta["usuario"];
                        $_SESSION["foto"] = $respuesta["foto"];
                        $_SESSION["perfil"] = $respuesta["perfil"];

                        // Registrar fecha para el ultimo login
                        date_default_timezone_set('America/Lima');
                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');
                        $fechaActual = $fecha.' '.$hora;
                        $item1 = "ultimo_login";
                        $valor1 = $fechaActual;
                        $item2 = "id";
                        $valor2 = $respuesta["id"];
                        $ultimoLogin = User::ActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                        if ($ultimoLogin == "ok") {
                            echo '<script>window.location = "inicio";</script>';
                        }
                    }else {
                        echo '<br><div class="alert alert-danger btnActivar">El usuario aún no está activado</div>';
                    }
                }else{
                    echo '<br><div class="alert alert-danger btnActivar">Error al ingresar, vuelve a intentarlo</div>';
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
                
                if ($_FILES["nuevaFoto"]["tmp_name"]){
                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                    $nuevoAncho = 500;
					$nuevoAlto = 500;
                    // Crear el directorio
                    $directorio = "public/img/users/".$_POST["nuevoUsuario"];
                    mkdir($directorio, 0755);
                    // De acuerdo al tipo de imagen aplicamos las funciones por defecto de php
                    if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "public/img/users/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
                    }

                    if($_FILES["nuevaFoto"]["type"] == "image/png"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "public/img/users/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
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

    static public function MostrarUsuario($item, $valor){
        $tabla = "usuarios";
        $respuesta = User::mdlMostrarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }

    // Editar Usuario
    static public function EditarUsuario(){
        if (isset($_POST["editarUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {
                // validar imagen
                $ruta = $_POST["fotoActual"];
                if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
                    $nuevoAncho = 500;
					$nuevoAlto = 500;
                    // Crear el directorio
                    $directorio = "public/img/users/".$_POST["editarUsuario"];
                    // Validar si existe una foto
                    if (!empty($_POST["fotoActual"])) {
                        unlink($_POST["fotoActual"]);
                    }else {
                        mkdir($directorio, 0755);
                    }
                    // De acuerdo al tipo de imagen aplicamos las funciones por defecto de php
                    if($_FILES["editarFoto"]["type"] == "image/jpeg"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "public/img/users/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino, $ruta);
                    }

                    if($_FILES["editarFoto"]["type"] == "image/png"){
                        // Guardamos la imagen en el directorio
                        $aleatorio = mt_rand(100,999);
						$ruta = "public/img/users/".$_POST["editarUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagepng($destino, $ruta);
                    }
                }
                $tabla = "usuarios";
                if ($_POST["editarPassword"] != "") {
                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {
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
                    
                }else {
                    $encriptar = $_POST["passwordActual"];
                }
                $datos = array("nombre" => $_POST["editarNombre"],
                            "usuario"   => $_POST["editarUsuario"],
                            "password"  => $encriptar,
                            "perfil"    => $_POST["editarPerfil"],
                            "foto"      => $ruta);
                $respuesta = User::EditarUsuario($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El usuario ha sido actualizado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "usuarios";
                            }
                        });
					</script>';
                }
            }else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "¡El nombre no puede ir vacío o llevar caracteres especiales!"
                    }).then(function(result){
						if(result.value){
							window.location = "usuarios";
						}
					});
				</script>';
            }
        }
    }

    // Borrar Usuario
    static public function BorrarUsuario(){
        if (isset($_GET["idUsuario"])) {
            $tabla = "usuarios";
            $datos = $_GET["idUsuario"];
            if ($_GET["fotoUsuario"] != "") {
                unlink($_GET["fotoUsuario"]);
                rmdir('vistas/img/usuarios'.$_GET["usuario"]);
            }
            $respuesta = User::BorrarUsuario($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El usuario ha sido borrado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
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