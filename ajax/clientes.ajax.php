<?php

require_once "../controllers/ClientController.php";
require_once "../models/Client.php";

class AjaxClientes{

    // Editar Cliente
    public $idCliente;

	public function ajaxEditarCliente(){
		$item = "id";
		$valor = $this->idCliente;
		$respuesta = ClientController::MostrarClientes($item, $valor);
		echo json_encode($respuesta);
	}
}

// Editar Cliente
if(isset($_POST["idCliente"])){
	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();
}