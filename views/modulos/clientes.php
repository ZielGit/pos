<?php
  if($_SESSION["perfil"] == "Especial"){
    echo '<script>
      window.location = "inicio";
    </script>';
    return;
  }
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Clientes</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
            Agregar Cliente
          </button>
        </div>
        <div class="card-body">
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nombre</th>
                <th>DNI/RUC</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Fecha de Nacimiento</th>
                <th>Total de compras</th>
                <th>Última compra</th>
                <th>Ingreso al sistema</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $item = null;
                $valor = null;
                $clientes = ClientController::MostrarClientes($item, $valor);

                foreach ($clientes as $key => $value) {
                  echo '<tr>
                          <td>'.$value["id"].'</td>
                          <td>'.$value["nombre"].'</td>
                          <td>'.$value["documento"].'</td>
                          <td>'.$value["email"].'</td>
                          <td>'.$value["telefono"].'</td>
                          <td>'.$value["direccion"].'</td>
                          <td>'.$value["fecha_nacimiento"].'</td>             
                          <td>'.$value["compras"].'</td>
                          <td>'.$value["ultima_compra"].'</td>
                          <td>'.$value["fecha"].'</td>
                          <td>
                            <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'">
                              <i class="fas fa-pencil-alt"></i>
                            </button>';

                            if ($_SESSION["perfil"] == "Administrador") {
                              echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                            }
                          echo '</td>
                        </tr>';
                }
              ?>
            </tbody>
          </table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
            <input type="text" class="form-control" name="nuevoTelefono" data-inputmask="'mask': ['999-999-999', '+099 999 999-999']" data-mask placeholder="Ingresar telefono" required>
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

<!-- Modal Editar Cliente-->
<div class="modal fade" id="modalEditarCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Editar Cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" name="editarCliente" id="editarCliente" required>
            <input type="hidden" id="idCliente" name="idCliente">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-id-card"></i></span>
            </div>
            <input type="number" class="form-control" name="editarDocumentoId" id="editarDocumentoId" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="email" class="form-control" name="editarEmail" id="editarEmail" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input type="text" class="form-control" name="editarTelefono" id="editarTelefono" data-inputmask="'mask': ['999-999-999 [x99999]', '+099 999 999[9]-999']" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
            </div>
            <input type="text" class="form-control" name="editarDireccion" id="editarDireccion" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>
            <input type="text" class="form-control" name="editarFechaNacimiento" id="editarFechaNacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" required>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar Cliente</button>
        </div>
        <?php
          $editarCliente = new ClientController();
          $editarCliente->EditarCliente();
        ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Modal Editar Cliente-->

<?php
  $eliminarCliente = new ClientController();
  $eliminarCliente->EliminarCliente();
?>