<?php

use Controllers\ClientController;
use Controllers\ProductController;
use Controllers\SaleController;
use Controllers\UserController;

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Venta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                      <li class="breadcrumb-item"><a href="ventas">Administrar Ventas</a></li>
                      <li class="breadcrumb-item active">Editar Venta</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-xl-5">
            <div class="card card-success card-outline">
              <div class="card-header">
              </div>
              <form class="formularioVenta" method="post">
                <div class="card-body pad table-responsive">
                  <?php
                    $item = "id";
                    $valor = $_GET["idVenta"];
                    $venta = SaleController::MostrarVentas($item, $valor);

                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];
                    $vendedor = UserController::MostrarUsuario($itemUsuario, $valorUsuario);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];
                    $cliente = ClientController::MostrarClientes($itemCliente, $valorCliente);

                    $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"];
                  ?>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">
                  </div>
                  
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-code"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>
                  </div>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-users"></i></span>
                    </div>
                    <select class="form-control" name="seleccionarCliente" id="seleccionarCliente" required>
                      <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>
                      <?php
                        $item = null;
                        $valor = null;
                        $cliente = ClientController::MostrarClientes($item, $valor);

                        foreach ($cliente as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                        }
                      ?>
                    </select>
                    <span class="input-group-append">
                      <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modalAgregarCliente">
                        Agregar Cliente
                      </button>
                    </span>
                  </div>
                  
                  <!-- Entrada para agregar producto -->
                  <div class="mb-2 nuevoProducto">
                    <?php
                      $listaProducto = json_decode($venta["productos"], true);

                      foreach ($listaProducto as $key => $value) {
                        $item = "id";
                        $valor = $value["id"];
                        $orden = "id";
                        $respuesta = ProductController::MostrarProductos($item, $valor, $orden);
                        $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                        echo '<div class="row mt-1">
                            <div class="col-md-6 mb-1">
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger btn-flat quitarProducto" idProducto="'.$value["id"].'"><i class="fas fa-times"></i></button>
                                    </div>
                                    <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>
                                </div>
                            </div>
        
                            <div class="col-md-3 mb-1 ingresoCantidad">
                                <div class="input-group">
                                    <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>
                                </div>
                            </div>
        
                            <div class="col-md-3 mb-1 ingresoPrecio">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
                                </div>
                            </div>
                        </div>';
                      }
                    ?>
                  </div>
                  <input type="hidden" id="listaProductos" name="listaProductos">

                  <button type="button" class="btn btn-info d-lg-none btnAgregarProducto">Agregar producto</button>
                  <hr>
                  
                  <div class="row">
                    <div class="col-md-8 ml-auto float-right">
                      <table class="table">
                        <thead>
                          <th>Impuesto</th>
                          <th>Total</th>
                        </thead>
                        <tbody>
                          <td>
                            <div class="input-group">
                              <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="<?php echo $porcentajeImpuesto; ?>" required>
                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" required>
                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="fas fa-percent"></i>
                                </span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["neto"]; ?>" value="<?php echo $venta["total"]; ?>" readonly required>
                              <input type="hidden" name="totalVenta" id="totalVenta" value="<?php echo $venta["total"]; ?>">
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="fas fa-dollar-sign"></i>
                                </span>
                              </div>
                            </div>
                          </td>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-credit-card"></i></span>
                        </div>
                        <select class="form-control" name="nuevoMetodoPago" id="nuevoMetodoPago" required>
                          <option value="">Selecione método de pago</option>
                          <option value="Efectivo">Efectivo</option>
                          <option value="TC">Tarjeta de crédito</option>
                          <option value="TD">Tarjeta de Débito</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-6 cajasMetodoPago"></div>
                    <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
                  </div>

                </div>
                <!-- /.card -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary ml-auto float-right">Guardar Cambios</button>
                </div>
                <?php
                  $editarVenta = new SaleController();
                  $editarVenta->EditarVenta();
                ?>
              </form>
            </div>
          </div>
          <!-- /.col -->

          <div class="col-sm-12 col-xl-7">
            <div class="card card-warning card-outline">
              <div class="card-header">
              </div>
              <div class="card-body pad table-responsive">
                <table class="table table-bordered table-striped tablaVentas">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Imagen</th>
                      <th>Código</th>
                      <th>Descripción</th>
                      <th>Stock</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Modal Agregar Cliente -->
<div class="modal fade" id="modalAgregarCliente" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" name="nuevoCliente" placeholder="Ingresar nombre" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-id-card"></i></span>
            </div>
            <input type="number" class="form-control" name="nuevoDocumentoId" placeholder="Ingresar documento" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control" name="nuevoEmail" placeholder="Ingresar email" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input type="text" class="form-control" name="nuevoTelefono" data-inputmask="'mask': ['999-999-999 [x99999]', '+099 999 999[9]-999']" data-mask placeholder="Ingresar telefono" required>
          </div>
          
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
            </div>
            <input type="text" class="form-control" name="nuevaDireccion" placeholder="Ingresar dirección" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>
            <input type="text" class="form-control" name="nuevaFechaNacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask placeholder="Ingresar fecha nacimiento" required>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Cliente</button>
        </div>
        <?php
          $crearCliente = new ClientController();
          $crearCliente->CrearCliente();
        ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal Agregar Cliente -->