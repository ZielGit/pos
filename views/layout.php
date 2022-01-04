<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Point of Sale</title>

  <link rel="icon" href="views/dist/img/AdminLTELogo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="views/plugins/icheck-1.0.3/skins/all.css">
  <!-- DataTables -->
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.css">

  <!-- Plugins -->
  <!-- jQuery -->
  <script src="views/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- InputMask -->
  <script src="views/plugins/moment/moment.min.js"></script>
  <script src="views/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>
  <!-- Sweet Alert 2 -->
  <!-- Se agrego al head para que se ejecute primero el script luego recien el codigo -->
  <script src="views/plugins/sweetalert2/sweetalert2.all.min.js"></script>
  <!-- iCheck -->
  <script src="views/plugins/icheck-1.0.3/icheck.min.js"></script>
  
</head>
<body class="hold-transition sidebar-mini">

  <?php
  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
    // <!-- Site wrapper -->
    echo'<div class="wrapper">';

    // <!-- Navbar -->
    include "modulos/Navbar.php";
    // <!-- /.navbar -->

    // <!-- Main Sidebar Container -->
    include "modulos/Sidebar.php";

    // <!-- Content Wrapper. Contains page content -->
    if(isset($_GET["ruta"])){
      if($_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "categorias" ||
        $_GET["ruta"] == "productos" ||
        $_GET["ruta"] == "clientes" ||
        $_GET["ruta"] == "ventas" ||
        $_GET["ruta"] == "crear-venta" ||
        $_GET["ruta"] == "reportes" ||
        $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";
      }else{
        include "modulos/404.php";
      }
    }else{
      include "modulos/inicio.php";
    }
    // <!-- /.content-wrapper -->

    // Footer
    include "modulos/Footer.php";

    echo '</div>';
    // <!-- ./wrapper -->
  }else{
    include "modulos/login.php";
  }
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<!-- DataTables  & Plugins -->
<!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script> -->
<script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="views/plugins/jszip/jszip.min.js"></script>
<script src="views/plugins/pdfmake/pdfmake.min.js"></script>
<script src="views/plugins/pdfmake/vfs_fonts.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Mis Script -->
<script src="views/dist/js/script.js"></script>
<script src="views/js/usuarios.js"></script>
<script src="views/js/categorias.js"></script>
<script src="views/js/productos.js"></script>
<script src="views/js/clientes.js"></script>
<script>
  $(document).ready(function(){
    // Inicializar iCheck
    $('input[type=radio],input[type=checkbox]').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue',
      increaseArea: '20%' // optional
    });

    // Inicializar Inputmask
    $(":input").inputmask();

    // activando link
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('a');
    const menuLength = menuItem.length;
    for (let i = 0; i < menuLength; i++) {
      if (menuItem[i].href === currentLocation) {
        menuItem[i].className = "nav-link active"
      }
    }
	});
</script>
</body>
</html>
