<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){
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
                    <h1>Reportes de Ventas</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-sm-6">
              <!-- Date and time range -->
              <div class="form-group">
                <div class="input-group">
                  <button type="button" class="btn btn-default float-right" id="daterange-btn2">
                    <i class="far fa-calendar-alt"></i> Rango de fecha
                    <i class="fas fa-caret-down"></i>
                  </button>
                </div>
              </div>
              <!-- /.form group -->
            </div>
            <div class="col-sm-6">
              <div class="form-group float-right">
                <?php 
                  if (isset($_GET["fechaInicial"])) {
                    echo '<a href="views/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';
                  } else {
                    echo '<a href="views/modulos/descargar-reporte.php?reporte=reporte">';
                  }
                ?>
                  <button class="btn btn-success float-right">
                    Descargar reporte en Excel
                  </button>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <?php
                include "reportes/grafico_ventas.php";
              ?>
            </div>
            <div class="col-md-6 col-12">
              <?php
                include "reportes/productos-mas-vendidos.php";
              ?>
            </div>
            <div class="col-md-6 col-12">
              <div class="col">
                <?php
                  include "reportes/vendedores.php";
                ?>
              </div>
              <div class="col">
                <?php
                  include "reportes/compradores.php";
                ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<script src="public/js/reportes.js"></script>