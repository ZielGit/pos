<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear Venta</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                      <li class="breadcrumb-item active">Crear Venta</li>
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
                  
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                  </div>
                  
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-code"></i></span>
                    </div>
                    <?php
                      $item = null;
                      $valor = null;
                      $ventas = SaleController::MostrarVentas($item, $valor);
                      if (!$ventas) {
                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                      } else {
                        foreach ($variable as $key => $value) {
                          # code...
                        }
                        $codigo = $value["codigo"] + 1;
                        echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                      }
                    ?>
                  </div>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-users"></i></span>
                    </div>
                    <select class="form-control" name="seleccionarCliente" id="seleccionarCliente" required>
                      <option value="">Selecionar Cliente</option>
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
                              <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>
                              <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                              <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="fas fa-percent"></i>
                                </span>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input type="text" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>
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
                  <button type="submit" class="btn btn-primary ml-auto float-right">Guardar Venta</button>
                </div>
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