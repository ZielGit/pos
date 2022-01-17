<?php

$item = null;
$valor = null;
$orden = "id";
$productos = ProductController::MostrarProductos($item, $valor, $orden);

?>

<!-- PRODUCT LIST -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Productos Agregados Recientemente</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2">
            <?php
                for ($i=0; $i < 10; $i++) { 
                    echo '
                        <li class="item">
                            <div class="product-img">
                                <img src="'.$productos[$i]["imagen"].'" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="" class="product-title">'.$productos[$i]["descripcion"].'
                                    <span class="badge badge-warning float-right">$'.$productos[$i]["precio_venta"].'</span>
                                </a>
                                <span class="product-description">
                                </span>
                            </div>
                        </li>
                    ';
                }
            ?>
            <!-- /.item -->
        </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
        <a href="productos" class="uppercase">Ver todos los productos</a>
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->