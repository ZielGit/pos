<?php
if($_SESSION["perfil"] == "Vendedor"){
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
                    <h1>Administrar Productos</h1>
                </div>
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
            <tbody>
            </tbody>
          </table>
          <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<!-- Modal Agregar Producto -->
<div class="modal fade" id="modalAgregarProducto" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Agregar Producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-tags"></i></span>
            </div>
            <select class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" required>
              <option value="" selected disabled>Selecionar Categoria</option>
              <?php
                $item = null;
                $valor = null;
                $categoria = CategoryController::MostrarCategorias($item, $valor);

                foreach ($categoria as $key => $value) {
                  echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                }
              ?>
            </select>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-barcode"></i></span>
            </div>
            <input type="text" class="form-control" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar Código de Barras" required>
            <span class="input-group-append">
              <button id="GenerarCodigo" type="button" class="btn btn-success btn-flat">
                Generar Codigo
              </button>
            </span>
          </div>

          <div id="codigoBarras">
            
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
            </div>
            <input type="text" class="form-control" id="nuevaDescripcion" name="nuevaDescripcion" placeholder="Ingresar Descripción" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-check"></i></span>
            </div>
            <input type="number" class="form-control" name="nuevoStock" min="0" placeholder="Ingresar Stock" required>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>
                </div>
                <input type="number" class="form-control" name="nuevoPrecioCompra" id="nuevoPrecioCompra" min="0" step="any" placeholder="Precio Compra" required>
              </div>
            </div>
          
            <div class="col-lg-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>
                </div>
                <input type="number" class="form-control" name="nuevoPrecioVenta" id="nuevoPrecioVenta" min="0" step="any" placeholder="Precio Venta" readonly required>
              </div>
              <br>

              <div class="input-group">
                <!-- Checkbox Porcentaje -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="porcentaje" checked>
                      Utilizar porcentaje
                    </label>
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
            <img class="img-thumbnail previsualizar" src="public/img/products/default/anonymous.png" alt="" width="100px">
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Producto</button>
        </div>
        <?php
          $crearProducto = new ProductController();
          $crearProducto->CrearProducto();
        ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.Modal Agregar Producto -->

<!-- Modal Editar Producto-->
<div class="modal fade" id="modalEditarProducto">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title">Editar Producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-tags"></i></span>
            </div>
            <select class="form-control input-lg" name="editarCategoria" readonly required>
              <option id="editarCategoria"></option>
            </select>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-barcode"></i></span>
            </div>
            <input type="text" class="form-control" id="editarCodigo" name="editarCodigo" readonly required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-comment-alt"></i></span>
            </div>
            <input type="text" class="form-control" id="editarDescripcion" name="editarDescripcion" required>
          </div>

          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-check"></i></span>
            </div>
            <input type="number" class="form-control" id="editarStock" name="editarStock" min="0" required>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-arrow-up"></i></span>
                </div>
                <input type="number" class="form-control" name="editarPrecioCompra" id="editarPrecioCompra" min="0" step="any" required>
              </div>
            </div>
          
            <div class="col-lg-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-arrow-down"></i></span>
                </div>
                <input type="number" class="form-control" name="editarPrecioVenta" id="editarPrecioVenta" min="0" step="any" readonly required>
              </div>
              <br>

              <div class="input-group">
                <!-- Checkbox Porcentaje -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="porcentaje" checked>
                      Utilizar porcentaje
                    </label>
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
            <div class="panel">Subir Foto</div>
            <input type="file" class="nuevaFoto" name="editarImagen">
            <p class="help-block">Peso máximo de la foto 2MB</p>
            <img class="img-thumbnail previsualizar" src="public/dist/img/avatar5.png" alt="" width="100px">
            <input type="hidden" name="imagenActual" id="imagenActual">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Editar Producto</button>
        </div>
        <?php
          $editarProducto = new ProductController();
          $editarProducto->EditarProducto();
        ?>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- Modal Editar Producto-->

<?php
  $eliminarProducto = new ProductController();
  $eliminarProducto->EliminarProducto();
?>