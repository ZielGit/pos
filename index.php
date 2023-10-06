<?php

require 'vendor/autoload.php';

use Controllers\LayoutController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$layout = new LayoutController();
$layout->Layout();
