// Editar Categoría
$(".btnEditarCategoria").click(function () {
    var idCategoria = $(this).attr("idCategoria");
    var datos = new FormData();
    datos.append("idCategoria", idCategoria);
    
    $.ajax({
        url:"ajax/categorias.ajax.php",
        method:"POST",
        data:datos,
        cache: false,
        contentType:false,
        processData:false,
        dataType:"json",
        success: function (respuesta) {
            $("#editarCategoria").val(respuesta["categoria"]);
            $("#idCategoria").val(respuesta["id"]);
        }
    })
})