<?php

require_once "controllers/LayoutController.php";
require_once "controllers/UserController.php";
require_once "controllers/CategoryController.php";
require_once "controllers/ProductController.php";
require_once "controllers/ClientController.php";
require_once "controllers/SaleController.php";

require_once "models/User.php";
require_once "models/Category.php";
require_once "models/Product.php";
require_once "models/Client.php";
require_once "models/Sale.php";

$layout = new LayoutController();
$layout->Layout();