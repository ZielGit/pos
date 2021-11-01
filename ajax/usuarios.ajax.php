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
    }


    if (isset($_POST["idUsuario"])) {
        $editar = new AjaxUsuarios();
        $editar->idUsuario = $_POST["idUsuario"];
        $editar->ajaxEditarUsuario();
    }
    