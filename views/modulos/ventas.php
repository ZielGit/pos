<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Ventas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                      <li class="breadcrumb-item active">Administrar Ventas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <a href="crear-venta">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarVenta">
              Agregar Venta
            </button>
          </a>
        </div>
        <div class="card-body">
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Código factura</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Forma de Pago</th>
                <th>Neto</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- <?php
                $item = null;
                $valor = null;
                //$ventas = SaleController::MostrarVentas($item, $valor);

                foreach ($Ventas as $key => $value) {
                  echo '<tr>
                          <td>'.$value["id"].'</td>
                          <td>'.$value["nombre"].'</td>
                          <td>'.$value["documento"].'</td>
                          <td>'.$value["email"].'</td>
                          <td>'.$value["telefono"].'</td>
                          <td>'.$value["direccion"].'</td>
                          <td>'.$value["fecha_nacimiento"].'</td>             
                          <td>'.$value["compras"].'</td>
                          <td>0000-00-00 00:00:00</td>
                          <td>'.$value["fecha"].'</td>
                          <td>
                            <button class="btn btn-warning btnEditarVenta" data-toggle="modal" data-target="#modalEditarVenta" idVenta="'.$value["id"].'">
                              <i class="fas fa-pencil-alt"></i>
                            </button>

                            <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>
                          </td>
                        </tr>';
                }
              ?> -->
            </tbody>
          </table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>