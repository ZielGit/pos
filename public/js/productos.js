// Cargar la tabla con ajax
// $.ajax({
//     url:"ajax/datatable-productos.ajax.php",
//     success: function (respuesta) {
//         console.log("respuesta", respuesta);
//     }
// })

var perfilOculto = $("#perfilOculto").val();

$('.tablaProductos').DataTable({
    "responsive": true, "lengthChange": true, "autoWidth": false,
    // dom: 'Bfrtip',
    // buttons:{
    //     dom:{
    //         button:{
    //             className: 'btn'
    //         }
    //     },
    //     buttons: [
    //         {
    //             extend:"excel",
    //             text: "Exportar a Excel",
    //             className: "btn btn-success"
    //         }
    //     ],
    // },
    "ajax": "ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
	},
    //"buttons": ["excel"],
}).buttons().container().appendTo('.tablaProductos_wrapper .col-md-6:eq(0)');

// Capturando la categoria para asignar código
// $("#nuevaCategoria").change(function () {
//     var idCategoria = $(this).val();
//     var datos = new FormData();
//     datos.append("idCategoria", idCategoria);
//     $.ajax({
//         url:"ajax/productos.ajax.php",
//         method:"POST",
//         data:datos,
//         cache:false,
//         contentType:false,
//         processData:false,
//         dataType:"json",
//         success: function (respuesta) {
//             if (!respuesta) {
//                 var nuevoCodigo = idCategoria+"01";
//                 $("#nuevoCodigo").val(nuevoCodigo);
//             } else {
//                 var nuevoCodigo = Number(respuesta["codigo"]) + 1;
//                 $("#nuevoCodigo").val(nuevoCodigo);
//             }
//         }
//     })
// })

// Numeros Aleatorios
function codigo_random(min, max){
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (1 + max - min) + min);
}

// Generar codigo de barras aleatorios
$("#GenerarCodigo").click(function () {
    // Si existe codigo de barras vaciarlo
    $("#codigoBarras").empty();
    resultado = codigo_random(1000000000000,9999999999999);
    $("#nuevoCodigo").val(resultado);
    $("#codigoBarras").append(
        '<svg id="barcode" class="col"></svg>'
    );
    var barcodeValue = $("#nuevoCodigo").val();
    JsBarcode("#barcode", barcodeValue, {
             
        displayValue: true,
        lineColor: "#24292e",
        width:2,
        height:40,	
        fontSize: 20					
      });	
})

// Agregando precio venta
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){
	if($(".porcentaje").prop("checked")){
		var valorPorcentaje = $(".nuevoPorcentaje").val();
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
        var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);
        $("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);
	}
})

// Cambio porcentaje
$(".nuevoPorcentaje").change(function(){
	if($(".porcentaje").prop("checked")){
		var valorPorcentaje = $(this).val();
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
        var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);
        $("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);
	}
})

$(".porcentaje").on("ifUnchecked",function(){
	$("#nuevoPrecioVenta").prop("readonly",false);
    $("#editarPrecioVenta").prop("readonly",false);
})

$(".porcentaje").on("ifChecked",function(){
	$("#nuevoPrecioVenta").prop("readonly",true);
    $("#editarPrecioVenta").prop("readonly",true);
})

// Subir imagen producto
$(".nuevaImagen").change(function() {
    var imagen = this.files[0];
    // Validar formato imagen
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $(".nuevaImagen").val("");
        Swal.fire({
            icon: "error",
            title: "Error al subir la imagen",
            text: "¡La imagen debe ser de formato JPG o PNG!"
        });
    }else if (imagen["size"] > 2000000) {
        $(".nuevaImagen").val("");
        Swal.fire({
            icon: "error",
            title: "Error al subir la imagen",
            text: "¡La imagen no debe pesar más de 2MB!"
        });
    }else{
        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function (event) {
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src", rutaImagen);
        })
    }
})

// Editar Producto
$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){
	var idProducto = $(this).attr("idProducto");
	var datos = new FormData();
    datos.append("idProducto", idProducto);
	$.ajax({
		url:"ajax/productos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			var datosCategoria = new FormData();
			datosCategoria.append("idCategoria",respuesta["id_categoria"]);
			$.ajax({
				url:"ajax/categorias.ajax.php",
				method: "POST",
				data: datosCategoria,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta){
					$("#editarCategoria").val(respuesta["id"]);
					$("#editarCategoria").html(respuesta["categoria"]);
				}
			})
			$("#editarCodigo").val(respuesta["codigo"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#editarStock").val(respuesta["stock"]);
			$("#editarPrecioCompra").val(respuesta["precio_compra"]);
			$("#editarPrecioVenta").val(respuesta["precio_venta"]);
			if(respuesta["imagen"] != ""){
				$("#imagenActual").val(respuesta["imagen"]);
				$(".previsualizar").attr("src",  respuesta["imagen"]);
			}
		}
	})
})

// Eliminar Producto
$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){
    var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");
    Swal.fire({
        title: "¿Está seguro de borrar el producto?",
        text: "¡Si no lo está puede cancelar la acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar producto!"
    }).then(function(result){
        if (result.value) {
            window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;
        }
    });
})