<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inicio</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php
            if ($_SESSION["perfil"] =="Administrador") {
              include "inicio/stat-box.php";
            }
          ?>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-lg-12">
            <?php
              if ($_SESSION["perfil"] =="Administrador") {
                include "reportes/grafico_ventas.php";
              }
            ?>
          </div>
          <div class="col-lg-6">
            <?php
              if ($_SESSION["perfil"] =="Administrador") {
                include "reportes/productos-mas-vendidos.php";
              }
            ?>
          </div>
          <div class="col-lg-6">
            <?php
              if ($_SESSION["perfil"] =="Administrador") {
                include "inicio/productos-recientes.php";
              }
            ?>
          </div>
          <div class="col-lg-12">
            <?php
              if ($_SESSION["perfil"] =="Especial" || $_SESSION["perfil"] =="Vendedor") {
                echo '
                  <div class="card card-success card-outline">
                    <div class="card-header">
                      <h1>Bienvenid@ '.$_SESSION["nombre"].'</h1>
                    </div>
                  </div>
                ';
              }
            ?>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>