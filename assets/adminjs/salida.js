window.onload = function() {
    initEvents();

    var json_materiales;
};

function initEvents() {
    get_materiales();


    $(document).off("click",".add_detalle").on("click",".add_detalle",function(event){
        var item= 1 + parseInt($(this).parents("tr").find(".item").text());
        var html = "";
        html+='<tr class="detalle_salida">';
            html+='<td class="item">'+item+'</td>';
            html+='<td>';
                html+='<select id="ds_materiales" class="form-control ds_materiales">';
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
            html+='<td class="detalle_acciones">';
                html+='<button class="btn add_detalle"> <i class="fa fa-plus"></i> </button>';
                html+='<button class="btn del_detalle"> <i class="fa fa-trash"></i> </button>';
            html+='</td>';
        html+='</tr>';
        $(this).parents("tr").find('.del_detalle').remove();
        $(this).parents("tr").find(".detalle_acciones").append('<button class="btn del_detalle"> <i class="fa fa-trash"></i> </button>');
        $(this).remove();
        $("#tbody_detallesalida").append(html);
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

    });

    $(document).off("click","#ingresar-salida").on("click","#ingresar-salida",function(event){
        var cantPer = true;
        var jsonObj = [];
        $('.detalle_salida').each(function (index, value) {
            item = {}
            item ["id_material"] = $(this).find('.ds_materiales').val();
            item ["cant_material"] = $(this).find('.cant_material').val();
            jsonObj.push(item);
            if ($(this).find('.cant_material').val() >  $(this).find(':selected').data('cant')) {
                cantPer = false;
            }

        });

        if (cantPer) {
            var jsonData = {vale:$("#vale").val(),
                        contratista:$("#contratista").val(),
                        observacion:$("#os_desc").val(),
                        detalle_salida:jsonObj
                    }

            $.ajax({
                type:"POST",
                url: window.location.origin+"/admin/salidas/crear",
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
                            $('#'+i).parent().addClass("has-error");
                            $('#'+i).after('<span class="help-block">'+item+'</span>');
                            $('textarea[name='+i+']').parent().addClass("has-error");
                            $('textarea[name='+i+']').after('<span class="help-block">'+item+'</span>');
                        });
                    }
                },
                error: function (xhr,exception) {
                    alert('error ajax');
                }
            })
        } else {
            swal("Cantidar Mayor a la existente", {
                  buttons: false,
                  timer: 1300,
                  icon:"error"
            });
        }

    });

}


function get_materiales() {
    var url_get = window.location.origin+"/admin/salidas/get_materiales";
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
                    html+='<option data-cant="'+json.datos[i].cantidad+'" value="'+json.datos[i].id_material+'">';
                        html+=json.datos[i].nombre;
                    html+='</option>';
                }
                $("#ds_materiales").html(html);
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



