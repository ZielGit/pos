<?php
require_once "../controllers/UserController.php";
require_once "../models/User.php";

    class AjaxUsuarios{
        // Editar Usuario
        public $idUsuario;

        public function ajaxEditarUsuario(){
            $item = "id";
            $valor = $this->idUsuario;
            $respuesta = UserController::MostrarUsuario($item, $valor);
            echo json_encode($respuesta);
        }

        // Activar Usuario
        public $activarUsuario;
        public $activarId;

        public function ajaxActivarUsuario(){
            $tabla = "usuarios";
            $item1 = "estado";
            $valor1 = $this->activarUsuario;
            $item2 = "id";
            $valor2 = $this->activarId;
            $respuesta = User::ActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
        }

        // Validar no repetir usuario
        public $validarUsuario;

        public function ajaxValidarUsuario(){
            $item = "usuario";
            $valor = $this->validarUsuario;
            $respuesta = UserController::MostrarUsuario($item, $valor);
            echo json_encode($respuesta);
        }
    }

    // Editar Usuario
    if (isset($_POST["idUsuario"])) {
        $editar = new AjaxUsuarios();
        $editar->idUsuario = $_POST["idUsuario"];
        $editar->ajaxEditarUsuario();
    }

    // Activar Usuario
    if (isset($_POST["activarUsuario"])) {
        $activarUsuario = new AjaxUsuarios();
        $activarUsuario->activarUsuario = $_POST["activarUsuario"];
        $activarUsuario->activarId = $_POST["activarId"];
        $activarUsuario->ajaxActivarUsuario();
    }

    // Validar no repetir usuario
    if (isset($_POST["validarUsuario"])) {
        $valUsuario = new AjaxUsuarios();
        $valUsuario->validarUsuario = $_POST["validarUsuario"];
        $valUsuario->ajaxValidarUsuario();
    }
    