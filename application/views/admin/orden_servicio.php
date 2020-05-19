<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Orden de Servicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Orden de servicio</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Crear Orden de Servicio</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Proveedor</label>
                                <select class="form-control" id="os_proveedor"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Cond. Pago</label>
                                <input id="cond_pago" type="text" class="form-control" placeholder="Credito, Contado, Anticipado">
                            </div>
                        </div><!-- 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">IVA  %</label>
                                <select class="form-control" id="os_ivas"></select>
                            </div>
                        </div> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Requerido Para:</label>
                                <input type="date" class="form-control" id="os_fecha_fin">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Recibe:</label>
                                <select class="form-control" id="os_recibe" placeholder="Elija Empleado"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Servicios</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Servicio</th>
                                        <th>Cantidad</th>
                                        <th>Actividad</th> 
                                        <th>Precio</th>
                                        <th>SubTotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_detalleorden">
                                    <tr class="detalle_orden">
                                        <td class="item">1</td>
                                        <td>
                                            <select id="os_servicios" class="form-control os_servicios">
                                                <option>Material</option>  
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control cant_servicio">
                                        </td>
                                        </td>
                                        <td>
                                            <select id="os_actividades" class="form-control os_actividades">
                                                <option>Actividad</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-right precio_servicio">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-right sub_total_ser" name="" readonly>
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
                                    <!-- <tr>
                                        <td colspan="3"></td>
                                        <th class="text-right"> IVA:</th>
                                        <td><input type="number" class="form-control totaliva text-right" value="0.00" readonly></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <th class="text-right">GRAN TOTAL:</th>
                                        <td><input type="number" class="form-control grantotal text-right" value="0.00" readonly></td>
                                    </tr> -->
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="inm_id">Observaciones</label>
                                <textarea class="form-control" id="os_desc">

                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4 text-right">
                            <button style="margin-top: 20px" id="ingresar-orden" class="btn btn-success btn-lg ">Ingresar Orden</button>
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

<script src="<?php echo base_url().'assets/adminjs/orden_servicio.js';?>"></script>

