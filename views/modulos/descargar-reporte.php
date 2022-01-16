<?php

require_once "../../controllers/SaleController.php";
require_once "../../models/Sale.php";
require_once "../../controllers/ClientController.php";
require_once "../../models/Client.php";
require_once "../../controllers/UserController.php";
require_once "../../models/User.php";

$reporte = new SaleController();
$reporte->DescargarReporte();