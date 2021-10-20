<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Usuarios</h1>
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
                          <td>1</td>
                          <td>'.$value["nombre"].'</td>
                          <td>'.$value["usuario"].'</td>';
                          if ($value["foto"] != "") {
                            echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                          } else {
                            echo '<td><img src="views/dist/img/avatar5.png" class="img-thumbnail" width="40px"></td>';
                          }
                          echo '<td>'.$value["perfil"].'</td>
                          <td><button class="btn btn-success btn-xs">Activado</button></td>
                          <td>'.$value["ultimo_login"].'</td>
                          <td>
                              <button class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button>
                              <button class="btn btn-danger"><i class="fa fa-times"></i></button>
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

<!-- Modal -->
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
            <input type="text" class="form-control input-log" name="nuevoNombre" placeholder="Ingresar Nombre" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-key"></i></span>
            </div>
            <input type="text" class="form-control input-log" name="nuevoUsuario" placeholder="Ingresar Usuario" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-lock"></i></span>
            </div>
            <input type="password" class="form-control input-log" name="nuevoPassword" placeholder="Ingresar Contraseña" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-users"></i></span>
            </div>
            <select class="form-control input-lg" name="nuevoPerfil" id="">
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
            <img class="img-thumbnail previsualizar" src="views/dist/img/avatar5.png" alt="" width="100px">
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