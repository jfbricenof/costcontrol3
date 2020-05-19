window.onload = function() {
    initEvents();

    var json_servicios;
    var json_actividades;
};

function initEvents() {
    get_proveedor();
    get_ivas();
    get_servicios();
    get_empleado();
    get_actividades();

    $(document).off("keyup",".precio_servicio").on("keyup",".precio_servicio",function(event){
        var price = $(this).val();
        var cant = $(this).parents("tr").find(".cant_servicio").val();
        $(this).parents("tr").find(".sub_total_ser").val(price*cant);

        var subtotal = 0;
        $('.sub_total_ser').each(function (index, value) {
            subtotal+=parseFloat($(this).val());
        });

        $(".total1").val(subtotal);
        /*var iva = parseFloat($("#os_ivas").find(':selected').data('iva'));
        var totaliva = subtotal*iva/100;
        $(".totaliva").val(totaliva);
        $(".grantotal").val(subtotal+totaliva);*/
    });

    $(document).off("keyup",".cant_servicio").on("keyup",".cant_servicio",function(event){
        var cant = $(this).val();
        var price = $(this).parents("tr").find(".precio_servicio").val();
        $(this).parents("tr").find(".sub_total_ser").val(price*cant);
    });

    $(document).off("click",".add_detalle").on("click",".add_detalle",function(event){
        var item= 1 + parseInt($(this).parents("tr").find(".item").text());
        var html = "";
        html+='<tr class="detalle_orden">';
            html+='<td class="item">'+item+'</td>';
            html+='<td>';
                html+='<select id="os_servicios" class="form-control os_servicios">';
                for (var i = 0; i < json_servicios.datos.length; i++) {
                    html+='<option value="'+json_servicios.datos[i].id_servicio+'">';
                        html+=json_servicios.datos[i].nombre;
                    html+='</option>';
                }
                html+='</select>';
            html+='</td>';
            html+='<td>';
                html+='<input type="number" class="form-control cant_servicio">';
            html+='</td>';
            html+='<td>';
                html+='<input type="number" class="form-control text-right precio_servicio">';
            html+='</td>';
            html+='<td>';
                html+='<input type="number" class="form-control text-right sub_total_ser" name="" readonly>';
            html+='</td>';
            html+='<td class="detalle_acciones">';
                html+='<button class="btn add_detalle"> <i class="fa fa-plus"></i> </button>';
                html+='<button class="btn del_detalle"> <i class="fa fa-trash"></i> </button>';
            html+='</td>';
        html+='</tr>';
        $(this).parents("tr").find('.del_detalle').remove();
        $(this).parents("tr").find(".detalle_acciones").append('<button class="btn del_detalle"> <i class="fa fa-trash"></i> </button>');
        $(this).remove();
        $("#tbody_detalleorden").append(html);
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
        $('.sub_total_ser').each(function (index, value) {
            total+=parseFloat($(this).val());
        });

        $(".total1").val(total);
        var iva = parseFloat($("#os_ivas").find(':selected').data('iva'));
        var totaliva = total*iva/100;
        $(".totaliva").val(totaliva);
        $(".grantotal").val(total+totaliva);
    });

    $(document).off("click","#ingresar-orden").on("click","#ingresar-orden",function(event){
        var jsonObj = [];
        $('.detalle_orden').each(function (index, value) {
            item = {}
            item ["id_servicio"] = $(this).find('.os_servicios').val();
            item ["cant_servicio"] = $(this).find('.cant_servicio').val();
            item ["id_actividad"] = $(this).find('.os_actividades').val();
            item ["precio_unit"] = $(this).find('.precio_servicio').val();
            item ["subtotal"] = $(this).find('.sub_total_ser').val();

            jsonObj.push(item);
        });
        var jsonData = {id_provee:$("#os_proveedor").val(),
                        cond_pago:$("#cond_pago").val(),
                        id_iva:$("#os_ivas").val(),
                        subtotal:$(".total1").val(),
                        total:$(".grantotal").val(),
                        observacion:$("#os_desc").val(),
                        fecha_fin:$("#os_fecha_fin").val(),
                        id_recibe:$("#os_recibe").val(),
                        detalle_orden:jsonObj
                    }

        $.ajax({
            type:"POST",
            url: window.location.origin+"/admin/orden_servicio/crear",
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
    var url_get = window.location.origin+"/admin/orden_servicio/get_proveedor";
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
                $("#os_proveedor").html(html);
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
    var url_get = window.location.origin+"/admin/orden_servicio/get_ivas";
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
                $("#os_ivas").html(html);
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

function get_servicios() {
    var url_get = window.location.origin+"/admin/orden_servicio/get_servicios";
    $.ajax({
        type : "POST",
        url  : url_get,
        dataType : "JSON",
        success: function(data){
            var json = JSON.parse(JSON.stringify(data));
            json_servicios = json;
            var html = "";
            if (json.res == "success") {
                for (var i = 0; i < json.datos.length; i++) {
                    html+='<option value="'+json.datos[i].id_servicio+'">';
                        html+=json.datos[i].nombre;
                    html+='</option>';
                }
                $("#os_servicios").html(html);
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

function get_empleado() {
    var url_get = window.location.origin+"/admin/orden_servicio/get_empleado";
    $.ajax({
        type : "POST",
        url  : url_get,
        dataType : "JSON",
        success: function(data){
            var json = JSON.parse(JSON.stringify(data));
            var html = "";
            if (json.res == "success") {
                for (var i = 0; i < json.datos.length; i++) {
                    html+='<option  value="'+json.datos[i].id_empleado+'">';
                        html+=json.datos[i].nombre+' '+json.datos[i].apellido;
                    html+='</option>';
                }
                $("#os_recibe").html(html);
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
    var url_get = window.location.origin+"/admin/orden_servicio/get_actividades";
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
                $(".os_actividades").html(html);
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

