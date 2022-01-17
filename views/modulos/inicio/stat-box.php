<?php

$item = null;
$valor = null;
$orden = "id";
$ventas = SaleController::SumaTotalVentas();

$categorias = CategoryController::MostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$clientes = ClientController::MostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = ProductController::MostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

?>

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3>$<?php echo number_format($ventas["total"],2); ?></h3>

            <p>Ventas</p>
        </div>
        <div class="icon">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <a href="ventas" class="small-box-footer">Más Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo number_format($totalCategorias); ?></sup></h3>

            <p>Categorías</p>
        </div>
        <div class="icon">
            <i class="fas fa-clipboard-list"></i>
        </div>
        <a href="categorias" class="small-box-footer">Más Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
        <div class="inner">
            <h3><?php echo number_format($totalClientes); ?></h3>

            <p>Clientes</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <a href="clientes" class="small-box-footer">Más Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo number_format($totalProductos); ?></h3>

            <p>Productos</p>
        </div>
        <div class="icon">
            <i class="fas fa-box"></i>
        </div>
        <a href="productos" class="small-box-footer">Más Info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->