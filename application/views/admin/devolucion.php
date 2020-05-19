<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Devolucion
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Devolucion</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Crear Devolucion de Materiales</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Proveedor</label>
                                <select class="form-control" id="dev_proveedor"></select>
                            </div>
                        </div><!-- 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">IVA  %</label>
                                <select class="form-control" id="dev_ivas"></select>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Materiales</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Material</th>
                                        <th>Cantidad</th>
                                        <th>Actividad</th>
                                        <th>Precio</th>
                                        <th>SubTotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_detalledevolucion">
                                    <tr class="detalle_devolucion">
                                        <td class="item">1</td>
                                        <td>
                                            <select id="dev_materiales" class="form-control dev_materiales">
                                                <option>Material</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control cant_material">
                                        </td>
                                        <td>
                                            <select id="dev_actividades" class="form-control dev_actividades">
                                                <option>Actividad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-right precio_material">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-right sub_total_mat" name="" readonly>
                                        </td>
                                        <td class="detalle_acciones">
                                            <button class="btn add_detalle"> <i class="fa fa-plus"></i> </button>
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <th class="text-right">TOTAL:</th>
                                        <td><input type="number" class="form-control total1 text-right" value="0.00" readonly></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="inm_id" >Comentario</label>
                                <textarea class="form-control" placeholder="Indique la factura o remisión con la que se recibió el material" id="dev_desc" >
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <button style="margin-top: 20px" id="ingresar-devolucion" class="btn btn-success btn-lg ">Ingresar Devolución</button>
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

<script src="<?php echo base_url().'assets/adminjs/devolucion.js';?>"></script>

