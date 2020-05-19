window.onload = function() {
    initEvents();
};

function initEvents() {
    // cuando se envia el formulario #add_empleado
    $("#add_usuario").on("submit",function () {
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") { // si se inserto correctamente en db
                    swal("Registro Almacenado", {
                          buttons: false,
                          timer: 1300,
                          icon:"success"
                    });
                    window.location.reload();
                }else{
                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $.each(json.errors, function(i, item) {
                        $('input[name='+i+']').parent().addClass("has-error");
                        $('input[name='+i+']').after('<span class="help-block">'+item+'</span>');
                        $('textarea[name='+i+']').parent().addClass("has-error");
                        $('textarea[name='+i+']').after('<span class="help-block">'+item+'</span>');
                    });
                }
            },
            error: function (xhr,exception) {
                alert('error ajax');
            }
        })
        return false;
    });
    // cuando se hace click en el boton .eliminar_empleado
    $(document).off('click','.eliminar_usuario').on('click','.eliminar_usuario', function(){
        var url = $(this).data('url'); // capturo ruta con id
        //$(this).parents("tr").attr("id","por_eliminar"); // marco la fila por eliminar
        swal({ // confirmar con Sweet
           title: "¿ realmente deseas eliminar ?",
           text: "Una vez que se elimine, ¡no podrá recuperar este registro!",
           icon: "warning",
           buttons: true,
           dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {   // si confirma se hace el ajax de eliminar
            $.ajax({
                type:"POST",
                url:url,
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.res == "success") { // si se elimino correctamente de la db
                        swal("Registro Eliminado", {
                          buttons: false,
                          timer: 1300,
                          icon:"success"
                        });
                        window.location.reload();
                    }else{
                        alert("json error");
                    }
                },
                error: function (xhr,exception) {
                    alert('error ajax');
                }
            })
          } else {
             $("#por_eliminar").removeAttr("id"); // si no confirma se quita la marca de la fila por eliminar
          }
        });
    });
    // cuando se hace click en el boton .btn-editar_empleado
    $(document).off('click','.editar_usuario').on('click','.editar_usuario', function(){
        var id = $(this).data('id_usuario');
        var url = $(this).data('url');//  capturo ruta con id

        $("#edit_usuario").attr("action",url); // agrego ruta con id al form

        $('input[name="usuario_tipo_edit"]').val($(this).parents("tr").find(".td_tipo").text());
        $('input[name="usuario_email_edit"]').val($(this).parents("tr").find(".td_email").text());
        $('input[name="usuario_pw_edit"]').val($(this).parents("tr").find(".td_pw").text());
        $('input[name="id_usuario"]').val(id);

        $("#modal-edit_usuario").modal("show");
    });

    $("#edit_usuario").on("submit",function () {
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") { // si se inserto correctamente en db
                    swal("Registro Actualizado", {
                          buttons: false,
                          timer: 1300,
                          icon:"success"
                    });
                    window.location.reload();
                }else{
                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $.each(json.errors, function(i, item) {
                        $('input[name='+i+']').parent().addClass("has-error");
                        $('input[name='+i+']').after('<span class="help-block">'+item+'</span>');
                        $('textarea[name='+i+']').parent().addClass("has-error");
                        $('textarea[name='+i+']').after('<span class="help-block">'+item+'</span>');
                    });
                }
            },
            error: function (xhr,exception) {
                alert('error ajax');
            }
        })
        return false;
    });


}


