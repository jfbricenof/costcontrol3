window.onload = function() {
    initEvents();
};

function initEvents() {
    // cuando se envia el formulario #add_empleado
    $("#add_empleado").on("submit",function () {
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
    $(document).off('click','.eliminar_empleado').on('click','.eliminar_empleado', function(){
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
    $(document).off('click','.editar_empleado').on('click','.editar_empleado', function(){
        var id = $(this).data('id_empleado');
        var url = $(this).data('url');//  capturo ruta con id

        $("#edit_empleado").attr("action",url); // agrego ruta con id al form

        $('input[name="empleado_nombre_edit"]').val($(this).parents("tr").find(".td_nombre").text());
        $('input[name="empleado_apellido_edit"]').val($(this).parents("tr").find(".td_apellido").text());
        $('input[name="empleado_telefono_edit"]').val($(this).parents("tr").find(".td_telefono").text());
        $('input[name="id_empleado"]').val(id);

        $("#modal-edit_empleado").modal("show");
    });

    $("#edit_empleado").on("submit",function () {
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


