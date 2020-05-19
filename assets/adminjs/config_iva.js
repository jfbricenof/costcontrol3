window.onload = function() {
    initEvents();
};

function initEvents() {
    // cuando se envia el formulario #add_tarifa
    $("#add_iva").on("submit",function () {
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
    // cuando se hace click en el boton .eliminar_iva
    $(document).off('click','.eliminar_iva').on('click','.eliminar_iva', function(){
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
    // cuando se hace click en el boton .btn-editar_tarifa
    $(document).off('click','.editar_iva').on('click','.editar_iva', function(){
        var id = $(this).data('id_iva');
        var url = $(this).data('url');//  capturo ruta con id

        $("#edit_iva").attr("action",url);
        //$("#edit_tarifa").attr("action",id_ruta); // agrego ruta con id al form

        $('input[name="iva_nombre_edit"]').val($(this).parents("tr").find(".td_nombre_iva").text());
        $('input[name="iva_porcentaje_edit"]').val($(this).parents("tr").find(".td_porcentaje").text());
        $('input[name="id_iva"]').val(id);

        $("#modal-edit_iva").modal("show");
    });

    $("#edit_iva").on("submit",function () {
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


    // cuando se envia el formulario #edit_tarifa
    $("#edit_tarifa").on("submit",function () {
        var tipo_inm = $("#edit_nom_tinmueble option:selected").text(); // tomo el valor del option seleccionado para imprimir
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") {

                    $("#por_editar .td_fecha_inicio").text(json.fecha_inicio); // imprimo descripcion nueva
                    $("#por_editar .td_fecha_fin").text(json.fecha_fin);
                    $("#por_editar .td_valor").text(json.valor);
                    $("#por_editar .td_tasa_mora").text(json.tasa_mora);
                    $("#por_editar .td_tasa_iva").text(json.tasa_iva);
                    $("#por_editar .td_descripcion").find("abbr").attr('title',json.descripcion);

                    swal("Registro Actualizado", {
                          buttons: false,
                          timer: 1300,
                          icon:"success"
                        });

                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $("#modal-edit_tarifa").modal("hide"); // oculto modal editar
                    $("#por_editar").removeAttr("id");  // remuevo la marca #por_editar de la fila
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

    $("#add_rubro").on("submit",function () {
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") {
                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $("#md-nuevo-rubro").modal("hide");
                    $("#nueva_mascota").find(".form-control").val("");

                    var html="";

                    html+= '<tr class="opc-rub'+json.id+'">';
                    html+=      '<td class="rub-nombre">'+json.rub_nombre+'</td>';
                    html+=      '<td class="rub-desc">'+json.rub_descripcion+'</td>';
                    html+=      '<td>';
                    html+=          '<div class="pull-right">';
                    html+=              '<button class="btn btn-sm btn-default rubro_editar" data-url="'+json.url+'config_presupuesto/editar_rubro/'+json.id+'" data-code="'+json.id+'" title="Editar"><span class="fa fa-pencil"></span></button>';
                    html+=              '<button class="btn btn-sm btn-default eliminar_rubro" data-url="'+json.url+'config_presupuesto/eliminar_rubro" data-code="'+json.id+'" title="Eliminar"><span class="fa fa-trash"></span></button>';
                    html+=          '</div>';
                    html+=      '</td>';
                    html+=  '</tr>';
                    $("#data-rubros").append(html);

                    swal("Registrado", {
                          buttons: false,
                          timer: 1300,
                          icon:"success"
                        });
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

            }
        })
        return false;
    });

    // cuando se hace click en el boton .eliminar_rubro
    $(document).off('click','.eliminar_rubro').on('click','.eliminar_rubro', function(){
        var id_rub = $(this).data('code');
        var ajax_url = $(this).data('url');
        swal({
            title: "Estás seguro?",
            text: "Estás seguro de que quieres eliminar el registro?",
            icon: "warning",
            dangerMode: true,
            buttons: true
        })
        .then(willDelete => {
            if (willDelete) {
                $.ajax({
                    type : "POST",
                    url  : ajax_url,
                    dataType : "JSON",
                    data : {id_tipo_rubro:id_rub},
                    success: function(data){
                        $(".opc-rub"+id_rub).remove();
                        swal("Eliminado", {
                          buttons: false,
                          timer: 1300,
                          icon:"success"
                        });
                    }
                });
            }
        });
    });

    $(document).off('click','.rubro_editar').on('click','.rubro_editar', function(){
        var url_edit = $(this).data('url');
        $("#edit_rubro").attr("action",url_edit);
        $("input[name='edit_rub_nombre']").val($(this).parents("tr").find(".rub-nombre").text());
        $("textarea[name='edit_rub_descripcion']").val($(this).parents("tr").find(".rub-desc").text());
        $("#md-edit-rubro").modal('show');
    });

    $("#edit_rubro").on("submit",function () {
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") {
                    $(".opc-rub"+json.id+" .rub-nombre").text(json.nombre);
                    $(".opc-rub"+json.id+" .rub-desc").text(json.descripcion);

                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $("#md-edit-rubro").modal("hide");

                    swal("Registrado", {
                          buttons: false,
                          timer: 1300,
                          icon:"success"
                        });
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

            }
        })
        return false;
    });
}


