window.onload = function() {
    initEvents();
};

function initEvents() {
    // cuando se envia el formulario #add_tarifa
    $("#add_provee").on("submit",function () {
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
    // cuando se hace click en el boton .ELIMINAR
    $(document).off('click','.eliminar_provee').on('click','.eliminar_provee', function(){
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
    // cuando se hace click en el boton .btn-editar_provee
    $(document).off('click','.editar_provee').on('click','.editar_provee', function(){
        var id = $(this).data('id_provee');
        var url = $(this).data('url');//  capturo ruta con id

        $("#edit_provee").attr("action",url);
        
        $('input[name="provee_razon_edit"]').val($(this).parents("tr").find(".td_razon").text());       
        $('input[name="provee_nit_edit"]').val($(this).parents("tr").find(".td_nit").text());
        $('input[name="provee_ncomercial_edit"]').val($(this).parents("tr").find(".td_ncomercial").text());
        $('input[name="provee_correo_edit"]').val($(this).parents("tr").find(".td_correo").text());
        $('input[name="provee_direccion_edit"]').val($(this).parents("tr").find(".td_direccion").text());
        $('input[name="provee_ciudad_edit"]').val($(this).parents("tr").find(".td_ciudad").text());
        $('input[name="provee_tel_edit"]').val($(this).parents("tr").find(".td_tel").text());
        $('input[name="provee_cel_edit"]').val($(this).parents("tr").find(".td_cel").text());
        $('input[name="provee_contacto_edit"]').val($(this).parents("tr").find(".td_contacto").text());
        $('input[name="id_provee"]').val(id);

        $("#modal-edit_provee").modal("show");
    });

    $("#edit_provee").on("submit",function () {
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


