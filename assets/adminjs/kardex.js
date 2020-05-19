window.onload = function() {
    initEvents();
};

function initEvents() {

    $(document).off('click','#ver_kardex').on('click','#ver_kardex', function(){
        var url_get = window.location.origin+"/admin/kardex/kardex_material";
        $.ajax({
            type : "POST",
            url  : url_get,
            dataType : "JSON",
            data : {id_material:$("#kd_material").val()},
            success: function(data){
                var json = JSON.parse(JSON.stringify(data));
                var html = "";
                //$("#table-creditos").dataTable().fnDestroy();
                if (json.res == "success") {
                    for (var i = 0; i < json.datos.length; i++) {
                        html+='<tr>';
                            html+='<td >'+json.datos[i].fecha+'</td>';
                            html+='<td >'+json.datos[i].tipo+'</td>';
                            html+='<td >'+json.datos[i].documento+'</td>';
                            html+='<td >'+json.datos[i].cantidad+'</td>';
                            html+='<td >'+json.datos[i].saldo+'</td>';
                        html+='</tr>';
                    }
                    $("#tbody_kardexes").html(html);
                }else{
                    $("#tbody_kardexes").html('');
                }
            },error: function(data) {
                swal("No se puede realizar la consulta", {
                  buttons: false,
                  timer: 1600,
                  icon:"error"
                });
            }
        });

    });

}


