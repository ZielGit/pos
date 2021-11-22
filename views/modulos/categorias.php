<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar categorias</h1>
                </div>
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
            Agregar Categoría
          </button>
        </div>
        <div class="card-body">

          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Categoría</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $item = null;
                $valor = null;
                $categorias = CategoryController::MostrarCategorias($item, $valor);

                foreach ($categorias as $key => $value) {
                  echo '<tr>
                          <td>'.$value["id"].'</td>
                          <td>'.$value["categoria"].'</td>
                          <td>
                              <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria">
                                <i class="fas fa-pencil-alt"></i>
                              </button>

                              <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i></button>
                          </td>
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

<!-- Modal Agregar Categoria -->
<div class="modal fade" id="modalAgregarCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Categoría</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-tags"></i></span>
            </div>
            <input type="text" class="form-control input-log" id="nuevaCategoria" name="nuevaCategoria" placeholder="Ingresar Categoría" required>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Categoria</button>
        </div>
        <?php
          $crearCategoria = new CategoryController();
          $crearCategoria->CrearCategoria();
        ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal Agregar Categoria -->

<!-- Modal Editar Categoria -->
<div class="modal fade" id="modalEditarCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Editar Categoría</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-tags"></i></span>
            </div>
            <input type="text" class="form-control input-log" id="editarCategoria" name="editarCategoria" value="" required>
            <input type="hidden" id="idCategoria" name="idCategoria">
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar Categoría</button>
        </div>
        <?php
          $editarCategoria = new CategoryController();
          $editarCategoria->EditarCategoria();
        ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal Editar Categoria -->

<?php
  $borrarCategoria = new CategoryController();
  $borrarCategoria->BorrarCategoria();
?>