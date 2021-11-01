$(".nuevaFoto").change(function() {
    var imagen = this.files[0];
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
        $(".nuevaFoto").val("");
        Swal.fire({
            icon: "error",
            title: "Error al subir la imagen",
            text: "¡La imagen debe ser de formato JPG o PNG!"
        });
    }else if (imagen["size"] > 2000000) {
        $(".nuevaFoto").val("");
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

// Editar Usuario
$(".btnEditarUsuario").click(function () {
    var idUsuario = $(this).attr("idUsuario");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
        url:"ajax/usuarios.ajax.php",
        method:"POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#fotoActual").val(respuesta["foto"]);
            $("#PasswordActual").val(respuesta["password"]);

            if (respuesta["foto"] != "") {
                $(".previsualizar").attr("src", respuesta["foto"]);
            }
        }
    })
})