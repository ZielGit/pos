<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Administrar Productos</h1>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
            Agregar Productos
          </button>
        </div>
        <div class="card-body">

          <table class="table table-bordered table-striped tablaProductos">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Imagen</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio de Compra</th>
                <th>Precio de Venta</th>
                <th>Agregado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <!-- <tbody>
              <?php 
                $item = null;
                $valor = null;
                $productos = ProductController::MostrarProductos($item, $valor);

                foreach ($productos as $key => $value) {
                  echo '<tr>
                          <td>'.$value["id"].'</td>
                          <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                          <td>'.$value["codigo"].'</td>
                          <td>'.$value["descripcion"].'</td>';
                          $item = "id";
                          $valor = $value["id_categoria"];
                          $categoria = CategoryController::MostrarCategorias($item, $valor);
                          echo '<td>'.$categoria["categoria"].'</td>
                          <td>'.$value["stock"].'</td>
                          <td>'.$value["precio_compra"].'</td>
                          <td>'.$value["precio_venta"].'</td>
                          <td>'.$value["fecha"].'</td>
                          <td>
                              <button class="btn btn-warning">
                                <i class="fas fa-pencil-alt"></i>
                              </button>

                              <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                          </td>
                        </tr>';
                }
              ?>
            </tbody> -->
          </table>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<!-- Modal Agregar Producto -->
<div class="modal fade" id="modalAgregarProducto">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-code"></i></span>
            </div>
            <input type="text" class="form-control input-log" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar Código" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-product-hunt"></i></span>
            </div>
            <input type="text" class="form-control input-log" id="nuevaDescripcion" name="nuevaDescripcion" placeholder="Ingresar Descripción" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-th"></i></span>
            </div>
            <select class="form-control input-lg" name="nuevaCategoria" id="">
              <option value="">Selecionar Categoria</option>
              <!-- <option value="Administrador">Administrador</option>
              <option value="Especial">Especial</option>
              <option value="Vendedor">Vendedor</option> -->
            </select>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-check"></i></span>
            </div>
            <input type="number" class="form-control input-log" name="nuevoStock" min="0" placeholder="Ingresar Stock" required>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>
                </div>
                <input type="number" class="form-control input-log" name="nuevoPrecioCompra" min="0" placeholder="Precio Compra" required>
              </div>
            </div>
          
            <div class="col-lg-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>
                </div>
                <input type="number" class="form-control input-log" name="nuevoPrecioVenta" min="0" placeholder="Precio Venta" required>
              </div>
              <br>

              <div class="input-group">
                <!-- Checkbox Porcentaje -->
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" id="icheck">
                      <label for="icheck">
                        Utilizar porcentaje
                      </label>
                    </div>
                  </div>
                </div>
                <!-- Entrada Porcentaje -->
                <div class="col-md-6">
                  <div class="input-group">
                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-percent"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="panel">Subir Imagen</div>
            <input type="file" class="nuevaImagen" name="nuevaImagen">
            <p class="help-block">Peso máximo de la foto 200MB</p>
            <img class="img-thumbnail previsualizar" src="views/dist/img/avatar5.png" alt="" width="100px">
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </div>
        <!-- <?php
          $crearCategoria = new CategoryController();
          $crearCategoria->CrearCategoria();
        ?> -->
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal Agregar Producto -->