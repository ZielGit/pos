// Cargar la tabla con ajax
// $.ajax({
//     url:"ajax/datatable-ventas.ajax.php",
//     success: function (respuesta) {
//         console.log("respuesta", respuesta);
//     }
// })

$('.tablaVentas').DataTable({
    "ajax": "ajax/datatable-ventas.ajax.php",
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
	}
});

// Agregando productos a la venta desde la tabla
$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){
    var idProducto = $(this).attr("idProducto");
	$(this).removeClass("btn-primary agregarProducto");
	$(this).addClass("btn-default");
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
        success:function (respuesta) {
            var descripcion = respuesta["descripcion"];
          	var stock = respuesta["stock"];
          	var precio = respuesta["precio_venta"];
            // Validar stock
            if (stock == 0) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "No hay stock disponible"
                });
                $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");
                return;
            }
            $(".nuevoProducto").append(
                '<div class="row mt-1">'+
                    '<div class="col-md-6 mb-1">'+
                        '<div class="input-group">'+
                            '<div class="input-group-append">'+
                                '<button type="button" class="btn btn-danger btn-flat quitarProducto" idProducto="'+idProducto+'"><i class="fas fa-times"></i></button>'+
                            '</div>'+
                            '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-3 mb-1">'+
                        '<div class="input-group">'+
                            '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-3 mb-1 ingresoPrecio">'+
                        '<div class="input-group">'+
                            '<div class="input-group-prepend">'+
                                '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
                            '</div>'+
                            '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
                        '</div>'+
                    '</div>'+
                '<div>'
            );
            // Sumar total de precios

            // Agregar Impuesto

            // Agrupar productos en formato json

            // Poner formato al precio de los productos

        }
    })
});

// Cuando cargue la tabla cada vez que cambies los datos a mostrar
$(".tablaVentas").on("draw.dt", function(){
	if(localStorage.getItem("quitarProducto") != null){
		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
		for(var i = 0; i < listaIdProductos.length; i++){
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
		}
	}
})

// Quitar productos de la venta y recuperar botón
var idQuitarProducto = [];
localStorage.removeItem("quitarProducto");
$(".formularioVenta").on("click", "button.quitarProducto", function(){
    $(this).parent().parent().parent().parent().remove();
	var idProducto = $(this).attr("idProducto");

    // Almacenar en el localStorage el id del producto a quitar
    if(localStorage.getItem("quitarProducto") == null){
		idQuitarProducto = [];
	}else{
		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))
	}
    
    idQuitarProducto.push({"idProducto":idProducto});
	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));
	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

    if($(".nuevoProducto").children().length == 0){
		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);
	}else{
		// Sumar total de precios
    	sumarTotalPrecios()
    	// Agregar impuesto
        agregarImpuesto()
        // Agrupar productos en formato json
        listarProductos()
	}
})

// Agregando productos desde el botón para dispositivos
var numProducto = 0;
$(".btnAgregarProducto").click(function(){
    numProducto ++;
    var datos = new FormData();
	datos.append("traerProductos", "ok");
    $.ajax({
        url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
        success:function (respuesta) {
            $(".nuevoProducto").append(
                '<div class="row mt-1">'+
                    '<div class="col-md-6 mb-1">'+
                        '<div class="input-group">'+
                            '<div class="input-group-append">'+
                                '<button type="button" class="btn btn-danger btn-flat quitarProducto" idProducto><i class="fas fa-times"></i></button>'+
                            '</div>'+
                            '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+
                                '<option>Seleccione el producto</option>'+
                            '</select>'+ 
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-3 mb-1 ingresoCantidad">'+
                        '<div class="input-group">'+
                            '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock nuevoStock required>'+
                        '</div>'+
                    '</div>'+

                    '<div class="col-md-3 mb-1 ingresoPrecio">'+
                        '<div class="input-group">'+
                            '<div class="input-group-prepend">'+
                                '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
                            '</div>'+
                            '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>'+
                        '</div>'+
                    '</div>'+
                '<div>'
            );
            // Agregar los productos al select
            respuesta.forEach(funcionForEach);
	        function funcionForEach(item, index){
	         	if(item.stock != 0){
		         	$("#producto"+numProducto).append(
					    '<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
		         	)
		        }
	        }
            // Sumar total de precios

            // Agregar Impuesto

            // Poner formato al precio de los productos
        }
    })
})

// Seleccionar Producto
$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){
    var nombreProducto = $(this).val();
    
    var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children().children(".nuevaCantidadProducto"); 
    var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);
    $.ajax({
        url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
        success:function (respuesta) {
            $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
            $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
            $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
            // Agrupar productos en formato json
        }
    })
})

// Cuando se modifica cantidad se modificara el precio del producto
$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){
    var precio = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
    var precioFinal = $(this).val() * precio.attr("precioReal");
    precio.val(precioFinal);
    var nuevoStock = Number($(this).attr("stock")) - $(this).val();
    $(this).attr("nuevoStock", nuevoStock);

    if (Number($(this).val()) > Number($(this).attr("stock"))) {
        // Si la cantidad es superior al stock regresar valores iniciales
        $(this).val(1);
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "La cantidad supera el Stock",
            confirmButtonText: "¡Cerrar!"
        });
        return;
    }
    // Sumar total de precios

    // Agregar Impuesto

    // Agrupar productos en formato json
})