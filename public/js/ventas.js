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
            sumarTotalPrecios()
            // Agregar Impuesto
            agregarImpuesto()
            // Agrupar productos en formato json
            listarProductos()
            // Poner formato al precio de los productos
            $(".nuevoPrecioProducto").number(true, 2);
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
                '</div>'
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
            sumarTotalPrecios()
            // Agregar Impuesto
            agregarImpuesto()
            // Poner formato al precio de los productos
            $(".nuevoPrecioProducto").number(true, 2);
        }
    })
})

// Seleccionar Producto
$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){
    var nombreProducto = $(this).val();
    var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");
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
            $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
            $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
            $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
            $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);
            // Agrupar productos en formato json
            listarProductos()
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
        var precioFinal = $(this).val() * precio.attr("precioReal");
		precio.val(precioFinal);
		sumarTotalPrecios();
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "La cantidad supera el Stock",
            confirmButtonText: "¡Cerrar!"
        });
        return;
    }
    // Sumar total de precios
    sumarTotalPrecios()
    // Agregar Impuesto
    agregarImpuesto()
    // Agrupar productos en formato json
    listarProductos()
})

// Sumar todos los precios
function sumarTotalPrecios(){
    var precioItem = $(".nuevoPrecioProducto");
	var arraySumaPrecio = [];
    for(var i = 0; i < precioItem.length; i++){
		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
	}
    function sumaArrayPrecios(total, numero){
		return total + numero;
	}
    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);
}

// Función agregar impuesto
function agregarImpuesto(){
	var impuesto = $("#nuevoImpuestoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");
	var precioImpuesto = Number(precioTotal * impuesto/100);
	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	$("#nuevoTotalVenta").val(totalConImpuesto);
	$("#totalVenta").val(totalConImpuesto);
	$("#nuevoPrecioImpuesto").val(precioImpuesto);
	$("#nuevoPrecioNeto").val(precioTotal);
}

// Cuando cambia el impuesto
$("#nuevoImpuestoVenta").change(function(){
	agregarImpuesto();
});

// Formato de precios
$("#nuevoTotalVenta").number(true, 2);

// Seleccionar método de pago
$("#nuevoMetodoPago").change(function(){
    var metodo = $(this).val();
    if (metodo == "Efectivo") {
        $(this).parent().parent().removeClass("col-sm-6");
        $(this).parent().parent().addClass("col-sm-4");
        $(this).parent().parent().parent().children(".cajasMetodoPago").removeClass("col-sm-6");
        $(this).parent().parent().parent().children(".cajasMetodoPago").addClass("col-sm-8");
        $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            '<div class="row">'+
                '<div class="col-6">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend">'+
                            '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
                        '</div>'+
                        '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="000000" required>'+
                    '</div>'+
                '</div>'+
                '<div class="col-6" id="capturarCambioEfectivo">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend">'+
                            '<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>'+
                        '</div>'+
                        '<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="000000" readonly required>'+
                    '</div>'+
                '</div>'+
            '</div>'
        )
        // Agregar formato al precio
        $('#nuevoValorEfectivo').number( true, 2);
      	$('#nuevoCambioEfectivo').number( true, 2);
        // Listar método en la entrada
        listarMetodos()
    } else {
        $(this).parent().parent().removeClass('col-sm-4');
        $(this).parent().parent().addClass('col-sm-6');
        $(this).parent().parent().parent().children(".cajasMetodoPago").removeClass("col-sm-8");
        $(this).parent().parent().parent().children(".cajasMetodoPago").addClass("col-sm-6");
        $(this).parent().parent().parent().children(".cajasMetodoPago").html(
            '<div class="col">'+
                '<div class="input-group">'+
                    '<input type="number" class="form-control" id="nuevoCodigoTransaccion" min="0" placeholder="Código transacción" required>'+
                    '<div class="input-group-prepend">'+
                        '<span class="input-group-text"><i class="fas fa-lock"></i></span>'+
                    '</div>'+
                '</div>'+
            '</div>'
        )
    }
})

// Cambio en efectivo
$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){
	var efectivo = $(this).val();
	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());
	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');
	nuevoCambioEfectivo.val(cambio);
})

// Cambio transsacción
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){
	// Listar método en la entrada
    listarMetodos()
})

// Listar todos los productos
function listarProductos(){
	var listaProductos = [];
	var descripcion = $(".nuevaDescripcionProducto");
	var cantidad = $(".nuevaCantidadProducto");
	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){
		listaProductos.push({
            "id"            : $(descripcion[i]).attr("idProducto"), 
			"descripcion"   : $(descripcion[i]).val(),
			"cantidad"      : $(cantidad[i]).val(),
			"stock"         : $(cantidad[i]).attr("nuevoStock"),
			"precio"        : $(precio[i]).attr("precioReal"),
			"total"         : $(precio[i]).val()
        })
	}

	$("#listaProductos").val(JSON.stringify(listaProductos)); 
}

// Listar método de pago
function listarMetodos(){
	var listaMetodos = "";
	if($("#nuevoMetodoPago").val() == "Efectivo"){
		$("#listaMetodoPago").val("Efectivo");
	}else{
		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
	}
}

// Boton editar venta
// $(".tablas").on("click", ".btnEditarVenta", function(){
$(".btnEditarVenta").click(function () {
	var idVenta = $(this).attr("idVenta");
	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;
})

// Función para desactivar los botones "agregar" cuando el producto ya había sido seleccionado en la venta
function quitarAgregarProducto(){
	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");
	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");
	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){
		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){
			if($(botonesTabla[j]).attr("idProducto") == boton){
				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");
			}
		}
	}
}

// Cada vez que cargue la tabla cuando navegamos en ella ejecutar la función
$('.tablaVentas').on( 'draw.dt', function(){
	quitarAgregarProducto();
})

// Eliminar Venta
// $(".tablas").on("click", ".btnEliminarVenta", function(){
$(".btnEliminarVenta").click(function () {
    var idVenta = $(this).attr("idVenta");
    Swal.fire({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
    }).then((result) => {
        if (result.value) {
            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }
    })
})
