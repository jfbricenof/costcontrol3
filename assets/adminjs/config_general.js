window.onload = function() {
    initEvents();
};

function initEvents() {

    var url_config_inm = location.href;
    // cuando se envia el formulario #actualizar_empresa
    $("#actualizar_empresa").on("submit",function () {
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") {
                    location.href = url_config_inm; // si se actualizo empresa actualizo url
                }else{
                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $.each(json.errors, function(i, item) {
                        $('input[name='+i+']').parent().addClass("has-error");
                        $('input[name='+i+']').after('<span class="help-block">'+item+'</span>');
                    });
                }
            },
            error: function (xhr,exception) {

            }
        })
        return false;
    });
    // cuando se envia el formulario #add_tipo_inmueble
    $("#add_tipo_inmueble").on("submit",function () {
        var new_row = '';
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") { // si se inserto correctamente en db
                    new_row += '<tr>'; // preparo html con la nueva fila
                    new_row +=     '<td class="td_nom_inm">'+json.nombre+'</td>';
                    new_row +=     '<td class="td_descrip_inm">'+json.descripcion+'</td>';
                    new_row +=     '<td>';
                    new_row +=         '<div class="pull-right">';
                    new_row +=             '<button class="btn btn-sm btn-default btn-editar_tipo_inm" data-idtipoinm="'+json.ruta_edit+'" title="Editar" data-toggle="modal" data-target="#modal-edit_tipo_inmueble"><span class="fa fa-pencil"></span></button>';
                    new_row +=             '<button class="btn btn-sm btn-default btn-eliminar_tipo_inm" data-idtipoinm="'+json.ruta_del+'" title="Eliminar"><span class="fa fa-trash"></span></button>';
                    new_row +=         '</div>';
                    new_row +=     '</td>';
                    new_row += '</tr>';

                    $("#tbody_tipo_inm").append(new_row); // inserto nueva fila en tabla

                    swal("Registro Almacenado", {
                          buttons: false,
                          timer: 1300,
                        });

                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $("#modal-add_tipo_inmueble").modal("hide");
                    $("#add_tipo_inmueble").find("input").val("");
                    $("#add_tipo_inmueble").find("textarea").val("");
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
    // cuando se hace click en el boton .btn-editar_tipo_inm
    $(document).off('click','.btn-editar_tipo_inm').on('click','.btn-editar_tipo_inm', function(){
        $("#por_editar").removeAttr("id");  //  remover todos las marcas por editar que quedaron
        var id_tipo_inm = $(this).data('idtipoinm'); //  capturo ruta con id
        $(this).parents("tr").attr("id","por_editar"); // marco fila para hacer cambio
        $("#edit_tipo_inmueble").attr("action",id_tipo_inm); // agrego ruta con id al form

        var nom_inm = $(this).parents("tr").find(".td_nom_inm").text(); // capturo nombre de tabla
        var descrip_inm = $(this).parents("tr").find(".td_descrip_inm").text(); // capturo descripcion de tabla

        $("#edit_nom_tinmueble").val(nom_inm); // pongo nombre en input del modal editar
        $("#edit_descrip_tinmueble").val(descrip_inm); // pongo descripcion en textarea del modal editar
    });
    // cuando se envia el formulario #edit_tipo_inmueble
    $("#edit_tipo_inmueble").on("submit",function () {
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") {

                    $("#por_editar .td_nom_inm").text(json.nombre); // imprimo nombre nuevo
                    $("#por_editar .td_descrip_inm").text(json.descripcion); // imprimo descripcion nueva

                    swal("Registro Actualizado", {
                          buttons: false,
                          timer: 1300,
                        });

                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $("#modal-edit_tipo_inmueble").modal("hide"); // oculto modal editar
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
    // cuando se hace click en el boton .btn-eliminar_tipo_inm
    $(document).off('click','.btn-eliminar_tipo_inm').on('click','.btn-eliminar_tipo_inm', function(){
        var id_ruta = $(this).data('idtipoinm'); // capturo ruta con id
        $(this).parents("tr").attr("id","por_eliminar"); // marco la fila por eliminar
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
                url:id_ruta,
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.res == "success") { // si se elimino correctamente de la db
                        $("#por_eliminar").remove();  // elimino la fila marcada
                        swal("Registro Eliminado", {
                          buttons: false,
                          timer: 1300,
                        });
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
    // cuando se envia el formulario #add_sector
    $("#add_sector").on("submit",function () {
        var new_row = '';
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") { // si se inserto correctamente en db
                    new_row += '<tr>'; // preparo html con la nueva fila
                    new_row +=     '<td class="td_nom_sector">'+json.nombre+'</td>';
                    new_row +=     '<td class="td_descrip_sector">'+json.descripcion+'</td>';
                    new_row +=     '<td>';
                    new_row +=         '<div class="pull-right">';
                    new_row +=             '<button class="btn btn-sm btn-default btn-editar_sector" data-id_ruta="'+json.ruta_edit+'" title="Editar" data-toggle="modal" data-target="#modal-edit_sector"><span class="fa fa-pencil"></span></button>';
                    new_row +=             '<button class="btn btn-sm btn-default btn-eliminar_sector" data-id_ruta="'+json.ruta_del+'" title="Eliminar"><span class="fa fa-trash"></span></button>';
                    new_row +=         '</div>';
                    new_row +=     '</td>';
                    new_row += '</tr>';

                    $("#tbody_sector").append(new_row); // inserto nueva fila en tabla

                    swal("Registro Almacenado", {
                          buttons: false,
                          timer: 1300,
                        });

                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $("#modal-add_sector").modal("hide");
                    $("#add_sector").find("input").val("");
                    $("#add_sector").find("textarea").val("");
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
    // cuando se hace click en el boton .btn-editar_sector
    $(document).off('click','.btn-editar_sector').on('click','.btn-editar_sector', function(){
        $("#por_editar").removeAttr("id");  //  remover todos las marcas por editar que quedaron
        var id_ruta = $(this).data('id_ruta'); //  capturo ruta con id
        $(this).parents("tr").attr("id","por_editar"); // marco fila para hacer cambio
        $("#edit_sector").attr("action",id_ruta); // agrego ruta con id al form

        var nom_sector = $(this).parents("tr").find(".td_nom_sector").text(); // capturo nombre de tabla
        var descrip_sector = $(this).parents("tr").find(".td_descrip_sector").text(); // capturo descripcion de tabla

        $("#edit_nom_sector").val(nom_sector); // pongo nombre en input del modal editar
        $("#edit_descrip_sector").val(descrip_sector); // pongo descripcion en textarea del modal editar
    });
    // cuando se envia el formulario #edit_sector
    $("#edit_sector").on("submit",function () {
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") {

                    $("#por_editar .td_nom_sector").text(json.nombre); // imprimo nombre nuevo
                    $("#por_editar .td_descrip_sector").text(json.descripcion); // imprimo descripcion nueva

                    swal("Registro Actualizado", {
                          buttons: false,
                          timer: 1300,
                        });

                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $("#modal-edit_sector").modal("hide"); // oculto modal editar
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
    // cuando se hace click en el boton .btn-eliminar_sector
    $(document).off('click','.btn-eliminar_sector').on('click','.btn-eliminar_sector', function(){
        var id_ruta = $(this).data('id_ruta'); // capturo ruta con id
        $(this).parents("tr").attr("id","por_eliminar"); // marco la fila por eliminar
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
                url:id_ruta,
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.res == "success") { // si se elimino correctamente de la db
                        $("#por_eliminar").remove();  // elimino la fila marcada
                        swal("Registro Eliminado", {
                          buttons: false,
                          timer: 1300,
                        });
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
    // cuando se envia el formulario #add_servicio
    $("#add_servicio").on("submit",function () {
        var new_row = '';
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") { // si se inserto correctamente en db
                    new_row += '<tr>'; // preparo html con la nueva fila
                    new_row +=     '<td class="td_nom_servicio">'+json.nombre+'</td>';
                    new_row +=     '<td class="td_descrip_servicio">'+json.descripcion+'</td>';
                    new_row +=     '<td>';
                    new_row +=         '<div class="pull-right">';
                    new_row +=             '<button class="btn btn-sm btn-default btn-editar_servicio" data-id_ruta="'+json.ruta_edit+'" title="Editar" data-toggle="modal" data-target="#modal-edit_servicio"><span class="fa fa-pencil"></span></button>';
                    new_row +=             '<button class="btn btn-sm btn-default btn-eliminar_servicio" data-id_ruta="'+json.ruta_del+'" title="Eliminar"><span class="fa fa-trash"></span></button>';
                    new_row +=         '</div>';
                    new_row +=     '</td>';
                    new_row += '</tr>';

                    $("#tbody_servicio").append(new_row); // inserto nueva fila en tabla

                    swal("Registro Almacenado", {
                          buttons: false,
                          timer: 1300,
                        });

                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $("#modal-add_servicio").modal("hide");
                    $("#add_servicio").find("input").val("");
                    $("#add_servicio").find("textarea").val("");
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
    // cuando se hace click en el boton .btn-editar_servicio
    $(document).off('click','.btn-editar_servicio').on('click','.btn-editar_servicio', function(){
        $("#por_editar").removeAttr("id");  //  remover todos las marcas por editar que quedaron
        var id_ruta = $(this).data('id_ruta'); //  capturo ruta con id
        $(this).parents("tr").attr("id","por_editar"); // marco fila para hacer cambio
        $("#edit_servicio").attr("action",id_ruta); // agrego ruta con id al form

        var nom_servicio = $(this).parents("tr").find(".td_nom_servicio").text(); // capturo nombre de tabla
        var descrip_servicio = $(this).parents("tr").find(".td_descrip_servicio").text(); // capturo descripcion de tabla

        $("#edit_nom_servicio").val(nom_servicio); // pongo nombre en input del modal editar
        $("#edit_descrip_servicio").val(descrip_servicio); // pongo descripcion en textarea del modal editar
    });
    // cuando se envia el formulario #edit_servicio
    $("#edit_servicio").on("submit",function () {
        $.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") {

                    $("#por_editar .td_nom_servicio").text(json.nombre); // imprimo nombre nuevo
                    $("#por_editar .td_descrip_servicio").text(json.descripcion); // imprimo descripcion nueva

                    swal("Registro Actualizado", {
                          buttons: false,
                          timer: 1300,
                        });

                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $("#modal-edit_servicio").modal("hide"); // oculto modal editar
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
    // cuando se hace click en el boton .btn-eliminar_servicio
    $(document).off('click','.btn-eliminar_servicio').on('click','.btn-eliminar_servicio', function(){
        var id_ruta = $(this).data('id_ruta'); // capturo ruta con id
        $(this).parents("tr").attr("id","por_eliminar"); // marco la fila por eliminar
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
                url:id_ruta,
                success: function (data) {
                    var json = JSON.parse(data);
                    if (json.res == "success") { // si se elimino correctamente de la db
                        $("#por_eliminar").remove();  // elimino la fila marcada
                        swal("Registro Eliminado", {
                          buttons: false,
                          timer: 1300,
                        });
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
}


