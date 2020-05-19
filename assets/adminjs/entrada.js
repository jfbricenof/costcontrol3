window.onload = function() {
    initEvents();

    var json_materiales;
    var json_actividades;
};

function initEvents() {
    get_proveedor();
    get_materiales();
    get_empleado();
    get_actividades();

    $(document).off("keyup",".precio_material").on("keyup",".precio_material",function(event){
        var price = $(this).val();
        var cant = $(this).parents("tr").find(".cant_material").val();
        $(this).parents("tr").find(".sub_total_mat").val(price*cant);

        var subtotal = 0;
        $('.sub_total_mat').each(function (index, value) {
            subtotal+=parseFloat($(this).val());
        });

        $(".total1").val(subtotal);
        /*var iva = parseFloat($("#en_iva").val());
        var totaliva = subtotal*iva/100;
        $(".totaliva").val(totaliva);
        $(".grantotal").val(subtotal+totaliva);*/
    });

    $(document).off("keyup",".cant_material").on("keyup",".cant_material",function(event){
        var cant = $(this).val();
        var price = $(this).parents("tr").find(".precio_material").val();
        $(this).parents("tr").find(".sub_total_mat").val(price*cant);

        var subtotal = 0;
        $('.sub_total_mat').each(function (index, value) {
            subtotal+=parseFloat($(this).val());
        });

        $(".total1").val(subtotal);
        /*var iva = parseFloat($("#en_iva").val());
        var totaliva = subtotal*iva/100;
        $(".totaliva").val(totaliva);
        $(".grantotal").val(subtotal+totaliva);*/
    });


    $(document).off("click",".del_detalle").on("click",".del_detalle",function(event){
        $(this).parents("tr").remove();

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
        /*var iva = parseFloat($("#en_iva").val());
        var totaliva = total*iva/100;
        $(".totaliva").val(totaliva);
        $(".grantotal").val(total+totaliva);*/
    });

    $(document).off("click","#ingresar-entrada").on("click","#ingresar-entrada",function(event){
        var jsonObj = [];
        $('.detalle_entrada').each(function (index, value) {
            item = {}
            item ["id_DetalleOrden"] = $(this).find('.orden').data("id");
            item ["cant_material"] = $(this).find('.cant_material').val();
            item ["cant_req"] = $(this).find('.cant_init').val();
            item ["id_actividad"] = $(this).find('.en_actividades').val();
            item ["precio_unit"] = $(this).find('.precio_material').val();
            item ["subtotal"] = $(this).find('.sub_total_mat').val();


            jsonObj.push(item);
        });
        var jsonData = {id_OrdenCompra:$("#en_id_OrdenCompra").val(),
                        en_remision:$("#en_remision").val(),
                        subtotal:$(".total1").val(),
                        total:$(".total1").val(),
                        observacion:$("#en_desc").val(),
                        en_factura:$("#en_factura").val(),
                        detalle_entrada:jsonObj
                    }

        $.ajax({
            type:"POST",
            url: window.location.origin+"/admin/entradas/crear_entrada",
            data:jsonData,
            success: function (data) {
                var json = JSON.parse(data);
                if (json.res == "success") { // si se inserto correctamente en db
                    swal("Registro Almacenado", {
                          buttons: false,
                          timer: 1300,
                          icon:"success"
                    });
                    window.location.origin+"/admin/entradas/listas";
                }else{
                    $('.help-block').remove();
                    $(".has-error").removeClass("has-error");
                    $.each(json.errors, function(i, item) {
                        $('input[id='+i+']').parent().addClass("has-error");
                        $('input[id='+i+']').after('<span class="help-block">'+item+'</span>');
                        $('textarea[id='+i+']').parent().addClass("has-error");
                        $('textarea[id='+i+']').after('<span class="help-block">'+item+'</span>');
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
    var url_get = window.location.origin+"/admin/orden_compra/get_proveedor";
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
                $("#oc_proveedor").html(html);
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
    var url_get = window.location.origin+"/admin/orden_compra/get_materiales";
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
                $("#oc_materiales").html(html);
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
    var url_get = window.location.origin+"/admin/orden_compra/get_empleado";
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
                $("#oc_recibe").html(html);
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
    var url_get = window.location.origin+"/admin/entradas/get_actividades";
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
                $(".en_actividades").html(html);
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


