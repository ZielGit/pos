<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Usuarios</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar Usuario
          </button>
        </div>
        <div class="card-body">

          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo Login</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $item = null;
                $valor = null;
                $usuarios = UserController::MostrarUsuario($item, $valor);

                foreach ($usuarios as $key => $value) {
                  echo '<tr>
                          <td>'.$value["id"].'</td>
                          <td>'.$value["nombre"].'</td>
                          <td>'.$value["usuario"].'</td>';
                          if ($value["foto"] != "") {
                            echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                          } else {
                            echo '<td><img src="public/dist/img/avatar5.png" class="img-thumbnail" width="40px"></td>';
                          }
                          echo '<td>'.$value["perfil"].'</td>';
                          if ($value["estado"] != 0) {
                            echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';
                          } else {
                            echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';
                          }
                          
                          echo '<td>'.$value["ultimo_login"].'</td>
                          <td>
                              <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario">
                                <i class="fas fa-pencil-alt"></i>
                              </button>

                              <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>
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

<!-- Modal Agregar Usuario-->
<div class="modal fade" id="modalAgregarUsuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingresar Nombre" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-key"></i></span>
            </div>
            <input type="text" class="form-control" id="nuevoUsuario" name="nuevoUsuario" placeholder="Ingresar Usuario" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-lock"></i></span>
            </div>
            <input type="password" class="form-control" name="nuevoPassword" placeholder="Ingresar Contraseña" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-users"></i></span>
            </div>
            <select class="form-control" name="nuevoPerfil" id="">
              <option value="">Selecionar Perfil</option>
              <option value="Administrador">Administrador</option>
              <option value="Especial">Especial</option>
              <option value="Vendedor">Vendedor</option>
            </select>
          </div>

          <div class="form-group">
            <div class="panel">Subir Foto</div>
            <input type="file" class="nuevaFoto" name="nuevaFoto">
            <p class="help-block">Peso máximo de la foto 200MB</p>
            <img class="img-thumbnail previsualizar" src="public/dist/img/avatar5.png" alt="" width="100px">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </div>
        <?php
          $crearUsuario = new UserController();
          $crearUsuario->CrearUsuario();
        ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Editar Usuario-->
<div class="modal fade" id="modalEditarUsuario">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Editar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
            </div>
            <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-key"></i></span>
            </div>
            <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" value="" readonly>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-lock"></i></span>
            </div>
            <input type="password" class="form-control" name="editarPassword" placeholder="Escriba la Nueva Contraseña" required>
            <input type="hidden" id="passwordActual" name="passwordActual">
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-users"></i></span>
            </div>
            <select class="form-control" name="editarPerfil" id="">
              <option value="" id="editarPerfil"></option>
              <option value="Administrador">Administrador</option>
              <option value="Especial">Especial</option>
              <option value="Vendedor">Vendedor</option>
            </select>
          </div>

          <div class="form-group">
            <div class="panel">Subir Foto</div>
            <input type="file" class="nuevaFoto" name="editarFoto">
            <p class="help-block">Peso máximo de la foto 2MB</p>
            <img class="img-thumbnail previsualizar" src="public/dist/img/avatar5.png" alt="" width="100px">
            <input type="hidden" name="fotoActual" id="fotoActual">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar Usuario</button>
        </div>
        <?php
          $editarUsuario = new UserController();
          $editarUsuario->EditarUsuario();
        ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
  $borrarUsuario = new UserController();
  $borrarUsuario->BorrarUsuario();
?>