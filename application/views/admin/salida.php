<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Salida de Almacén
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Salida de Almacén</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Crear Salida de Almacén</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inm_id">N. Vale</label>
                                <input id="vale" type="text" class="form-control" >              
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="inm_id">Contratista</label>
                                <input id="contratista" type="text" class="form-control" placeholder="Razón Social">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Salidas</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="col-xs-1">#</th>
                                        <th class="col-xs-6">Material</th>
                                        <th class="col-xs-2">Cantidad</th>
                                        <th class="col-xs-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_detallesalida">
                                    <tr class="detalle_salida">
                                        <td class="item">1</td>
                                        <td>
                                            <select id="ds_materiales" class="form-control ds_materiales">
                                                <option>Material</option>  
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control cant_material">
                                        </td>
                                        <td class="detalle_acciones">
                                            <button class="btn add_detalle"> <i class="fa fa-plus"></i> </button>
                                        </td>
                                    </tr>

                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="inm_id">Observaciones</label>
                                <textarea class="form-control" id="sal_desc">
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <button style="margin-top: 20px" id="ingresar-salida" class="btn btn-success btn-lg ">Ingresar Salida</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<script src="<?php echo base_url().'assets/adminjs/salida.js';?>"></script>

