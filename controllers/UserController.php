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
}