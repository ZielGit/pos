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
            include "inicio/stat-box.php";
          ?>
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-lg-12">
            <?php
              include "reportes/grafico_ventas.php";
            ?>
          </div>
          <div class="col-lg-6">
            <?php
              include "reportes/productos-mas-vendidos.php";
            ?>
          </div>
          <div class="col-lg-6">
            <?php
              include "inicio/productos-recientes.php";
            ?>
          </div>
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>