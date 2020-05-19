window.onload = function() {
    initEvents();

    var json_materiales;
    var json_actividades;
};

function initEvents() {
    get_actividades();
    get_proveedor();
    get_ivas();
    get_materiales();

    $(document).off("keyup",".precio_material").on("keyup",".precio_material",function(event){
        var price = $(this).val();
        var cant = $(this).parents("tr").find(".cant_material").val();
        $(this).parents("tr").find(".sub_total_mat").val(price*cant);

        var subtotal = 0;
        $('.sub_total_mat').each(function (index, value) {
            subtotal+=parseFloat($(this).val());
        });

        $(".total1").val(subtotal);
        /*var iva = parseFloat($("#dev_ivas").find(':selected').data('iva'));
        var totaliva = subtotal*iva/100;
        $(".totaliva").val(totaliva);
        $(".grantotal").val(subtotal+totaliva);*/
    });

    $(document).off("keyup",".cant_material").on("keyup",".cant_material",function(event){
        var cant = $(this).val();
        var price = $(this).parents("tr").find(".precio_material").val();
        $(this).parents("tr").find(".sub_total_mat").val(price*cant);
    });

    $(document).off("click",".add_detalle").on("click",".add_detalle",function(event){
        var item= 1 + parseInt($(this).parents("tr").find(".item").text());
        var html = "";
        html+='<tr class="detalle_devolucion">';
            html+='<td class="item">'+item+'</td>';
            html+='<td>';
                html+='<select id="dev_materiales" class="form-control dev_materiales">';
                for (var i = 0; i < json_materiales.datos.length; i++) {
                    html+='<option value="'+json_materiales.datos[i].id_material+'">';
                        html+=json_materiales.datos[i].nombre;
                    html+='</option>';
                }
                html+='</select>';
            html+='</td>';
            html+='<td>';
                html+='<input type="number" class="form-control cant_material">';
            html+='</td>';
            html+='<td>';
                html+='<select id="dev_actividades" class="form-control dev_actividades">';
                for (var i = 0; i < json_actividades.datos.length; i++) {
                    html+='<option value="'+json_actividades.datos[i].id_actividad+'">';
                        html+=json_actividades.datos[i].nombre;
                    html+='</option>';
                }
                html+='</select>';
            html+='</td>';
            html+='<td>';
                html+='<input type="number" class="form-control text-right precio_material">';
            html+='</td>';
            html+='<td>';
                html+='<input type="number" class="form-control text-right sub_total_mat" name="" readonly>';
            html+='</td>';
            html+='<td class="detalle_acciones">';
                html+='<button class="btn add_detalle"> <i class="fa fa-plus"></i> </button>';
                html+='<button class="btn del_detalle"> <i class="fa fa-trash"></i> </button>';
            html+='</td>';
        html+='</tr>';
        $(this).parents("tr").find('.del_detalle').remove();
        $(this).parents("tr").find(".detalle_acciones").append('<button class="btn del_detalle"> <i class="fa fa-trash"></i> </button>');
        $(this).remove();
        $("#tbody_detalledevolucion").append(html);
    });

    $(document).off("click",".del_detalle").on("click",".del_detalle",function(event){
        $(this).parents("tr").remove();
        var html = "";
        html+='<button class="btn add_detalle"> <i class="fa fa-plus"></i> </button>';
        html+='<button class="btn del_detalle"> <i class="fa fa-trash"></i> </button>';
        $(".detalle_acciones").last().html(html);

        var items = $(".detalle_acciones").length;
        console.log(items)
        if (items == 1) {
            var html2 = "";
            html2+='<button class="btn add_detalle"> <i class="fa fa-plus"></i> </button>';
            $(".detalle_acciones").html(html2);
        }

        var total = 0;
        $('.sub_total_mat').each(function (index, value) {
            total+=parseFloat($(this).val());
        });

        $(".total1").val(total);
        /*var iva = parseFloat($("#dev_ivas").find(':selected').data('iva'));
        var totaliva = total*iva/100;
        $(".totaliva").val(totaliva);
        $(".grantotal").val(total+totaliva);*/
    });

    $(document).off("click","#ingresar-devolucion").on("click","#ingresar-devolucion",function(event){
        var jsonObj = [];
        $('.detalle_devolucion').each(function (index, value) {
            item = {}
            item ["id_material"] = $(this).find('.dev_materiales').val();
            item ["cant_material"] = $(this).find('.cant_material').val();
            item ["id_actividad"] = $(this).find('.dev_actividades').val();
            item ["precio_unit"] = $(this).find('.precio_material').val();
            item ["subtotal"] = $(this).find('.sub_total_mat').val();

            jsonObj.push(item);
        });
        var jsonData = {id_provee:$("#dev_proveedor").val(),
                        id_iva:$("#dev_ivas").val(),
                        subtotal:$(".total1").val(),
                        total:$(".total1").val(),
                        observacion:$("#dev_desc").val(),
                        detalle_devolucion:jsonObj
                    }

        $.ajax({
            type:"POST",
            url: window.location.origin+"/admin/devolucion/crear",
            data:jsonData,
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
    });

}

function get_proveedor() {
    var url_get = window.location.origin+"/admin/devolucion/get_proveedor";
    $.ajax({
        type : "POST",
        url  : url_get,
        dataType : "JSON",
        success: function(data){
            var json = JSON.parse(JSON.stringify(data));
            var html = "";
            if (json.res == "success") {
                for (var i = 0; i < json.datos.length; i++) {
                    html+='<option value="'+json.datos[i].id_provee+'">';
                        html+=json.datos[i].razon;
                    html+='</option>';
                }
                $("#dev_proveedor").html(html);
            }
        },error: function(data) {
            swal("No se puede realizar la consulta", {
              buttons: false,
              timer: 1600,
              icon:"error"
            });
        }
    });
}

function get_ivas() {
    var url_get = window.location.origin+"/admin/devolucion/get_ivas";
    $.ajax({
        type : "POST",
        url  : url_get,
        dataType : "JSON",
        success: function(data){
            var json = JSON.parse(JSON.stringify(data));
            var html = "";
            if (json.res == "success") {
                for (var i = 0; i < json.datos.length; i++) {
                    html+='<option data-iva="'+json.datos[i].porcentaje_iva+'" value="'+json.datos[i].id_iva+'">';
                        html+=json.datos[i].nombre_iva+' ('+json.datos[i].porcentaje_iva+' %)';
                    html+='</option>';
                }
                $("#dev_ivas").html(html);
            }
        },error: function(data) {
            swal("No se puede realizar la consulta", {
              buttons: false,
              timer: 1600,
              icon:"error"
            });
        }
    });
}

function get_materiales() {
    var url_get = window.location.origin+"/admin/devolucion/get_materiales";
    $.ajax({
        type : "POST",
        url  : url_get,
        dataType : "JSON",
        success: function(data){
            var json = JSON.parse(JSON.stringify(data));
            json_materiales = json;
            var html = "";
            if (json.res == "success") {
                for (var i = 0; i < json.datos.length; i++) {
                    html+='<option value="'+json.datos[i].id_material+'">';
                        html+=json.datos[i].nombre;
                    html+='</option>';
                }
                $("#dev_materiales").html(html);
            }
        },error: function(data) {
            swal("No se puede realizar la consulta", {
              buttons: false,
              timer: 1600,
              icon:"error"
            });
        }
    });
}

function get_actividades() {
    var url_get = window.location.origin+"/admin/devolucion/get_actividades";
    $.ajax({
        type : "POST",
        url  : url_get,
        dataType : "JSON",
        success: function(data){
            var json = JSON.parse(JSON.stringify(data));
            json_actividades = json;
            var html = "";
            if (json.res == "success") {
                for (var i = 0; i < json.datos.length; i++) {
                    html+='<option value="'+json.datos[i].id_actividad+'">';
                        html+=json.datos[i].nombre;
                    html+='</option>';
                }
                $("#dev_actividades").html(html);
            }
        },error: function(data) {
            swal("No se puede realizar la consulta", {
              buttons: false,
              timer: 1600,
              icon:"error"
            });
        }
    });
}

