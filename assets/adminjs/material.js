window.onload = function() {
    initEvents();
};

function initEvents() {
    // cuando se envia el formulario #add_tarifa
    $("#add_material").on("submit",function () {
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
    $(document).off('click','.eliminar_material').on('click','.eliminar_material', function(){
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
    // cuando se hace click en el boton .btn-editar_material
    $(document).off('click','.editar_material').on('click','.editar_material', function(){
        var id = $(this).data('id_material');
        var url = $(this).data('url');//  capturo ruta con id
        alert(2)
        console.log($(this).parents("tr").find(".td_nombre").text());
        $("#edit_material").attr("action",url);

        $('input[name="material_nombre_edit"]').val($(this).parents("tr").find(".td_nombre").text());
        $('input[name="material_unidad_edit"]').val($(this).parents("tr").find(".td_unidad").text());
        $('input[name="material_tipo_edit"]').val($(this).parents("tr").find(".td_tipo").text());
        $('input[name="id_material"]').val(id);

        $("#modal-edit_material").modal("show");
    });

    $("#edit_material").on("submit",function () {
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

    $("#add_servicio").on("submit",function () {
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
    $(document).off('click','.eliminar_servicio').on('click','.eliminar_servicio', function(){
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
    // cuando se hace click en el boton .btn-editar_material
    $(document).off('click','.editar_servicio').on('click','.editar_servicio', function(){
        var id = $(this).data('id_servicio');
        var url = $(this).data('url');//  capturo ruta con id

        $("#edit_servicio").attr("action",url);

        $('input[name="servicio_nombre_edit"]').val($(this).parents("tr").find(".td_nombre").text());
        $('input[name="servicio_unidad_edit"]').val($(this).parents("tr").find(".td_unidad").text());
        $('input[name="servicio_tipo_edit"]').val($(this).parents("tr").find(".td_tipo").text());
        $('input[name="id_servicio"]').val(id);

        $("#modal-edit_servicio").modal("show");
    });

    $("#edit_servicio").on("submit",function () {
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
                    $('#modal-edit_servicio').modal('hide');
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


