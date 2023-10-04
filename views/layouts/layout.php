<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Point of Sale</title>

		<link rel="icon" href="public/dist/img/AdminLTELogo.png">

		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
		<!-- Daterange Picker -->
		<link rel="stylesheet" href="public/plugins/daterangepicker/daterangepicker.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="public/plugins/icheck-1.0.3/skins/all.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" href="public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" href="public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="public/plugins/select2/css/select2.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="public/dist/css/adminlte.css">

		<!-- Plugins -->
		<!-- jQuery -->
		<script src="public/plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- Select2 -->
		<script src="public/plugins/select2/js/select2.full.min.js"></script>
		<!-- InputMask -->
		<script src="public/plugins/moment/moment.min.js"></script>
		<script src="public/plugins/inputmask/jquery.inputmask.min.js"></script>
		<!-- date-range-picker -->
		<script src="public/plugins/daterangepicker/daterangepicker.js"></script>
		<!-- AdminLTE App -->
		<script src="public/dist/js/adminlte.min.js"></script>
		<!-- Sweet Alert 2 -->
		<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
		<!-- iCheck 1.0.3 -->
		<script src="public/plugins/icheck-1.0.3/icheck.min.js"></script>
		<!-- JQuery Number 2.1.6 -->
		<script src="public/plugins/jquery-number/jquery.number.min.js"></script>
		<!-- ChartJS -->
		<script src="public/plugins/chart.js/Chart.min.js"></script>
		<!-- DataTables  & Plugins -->
		<script src="public/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<script src="public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
		<script src="public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
		<script src="public/plugins/jszip/jszip.min.js"></script>
		<script src="public/plugins/pdfmake/pdfmake.min.js"></script>
		<script src="public/plugins/pdfmake/vfs_fonts.js"></script>
		<script src="public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
		<script src="public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
		<script src="public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
		<!-- JsBarcode 3.11.5 -->
		<script src="public/plugins/JsBarcode/JsBarcode.all.min.js"></script>
	</head>
	<body class="hold-transition sidebar-mini">
		<?php
			if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
				// <!-- Site wrapper -->
				echo '<div class="wrapper">';

				// <!-- Navbar -->
				include "navbar.php";
				// <!-- /.navbar -->

				// <!-- Main Sidebar Container -->
				include "sidebar.php";

				// <!-- Content Wrapper. Contains page content -->
				if (isset($_GET["ruta"])) {
					if (
						$_GET["ruta"] == "inicio" ||
						$_GET["ruta"] == "usuarios" ||
						$_GET["ruta"] == "categorias" ||
						$_GET["ruta"] == "productos" ||
						$_GET["ruta"] == "clientes" ||
						$_GET["ruta"] == "ventas" ||
						$_GET["ruta"] == "crear-venta" ||
						$_GET["ruta"] == "editar-venta" ||
						$_GET["ruta"] == "reportes" ||
						$_GET["ruta"] == "salir"
					) {

						include __DIR__ . "/../modulos/" . $_GET["ruta"] . ".php";
					} else {
						include __DIR__ . "/../modulos/404.php";
					}
				} else {
					include __DIR__ . "/../modulos/inicio.php";
				}
				// <!-- /.content-wrapper -->

				// Footer
				include "footer.php";

				echo '</div>';
				// <!-- ./wrapper -->
			} else {
				include __DIR__ . "/../modulos/login.php";
			}
		?>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->

		<!-- Mis Script -->
		<script src="public/dist/js/script.js"></script>
		<script src="public/js/usuarios.js"></script>
		<script src="public/js/categorias.js"></script>
		<script src="public/js/productos.js"></script>
		<script src="public/js/clientes.js"></script>
		<!-- <script src="public/js/ventas.js"></script> -->
		<!-- <script src="public/js/reportes.js"></script> -->
		<script>
			$(document).ready(function() {
				//Initialize Select2 Elements
				$('.select2').select2()

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