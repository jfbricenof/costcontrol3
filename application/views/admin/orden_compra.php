<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Orden de Compra
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Orden de Compra</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Crear Orden de Compra Materiales</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Proveedor</label>
                                <select class="form-control" id="oc_proveedor"></select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Requisición</label>
                                <input id="oc_requisicion"  class="form-control" type="text" name="" placeholder="Ingrese el #">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Cond. Pago</label>
                                <input id="cond_pago" type="text" class="form-control" placeholder="Credito, Contado, Anticipado">
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">IVA  %</label>
                                <select class="form-control" id="oc_ivas"></select>
                            </div>
                        </div> -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Fecha Requisición:</label>
                                <input type="date" class="form-control" id="oc_fecha_requi">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Requerido Para:</label>
                                <input type="date" class="form-control" id="oc_fecha_entrega">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Recibe:</label>
                                <select class="form-control" id="oc_recibe" placeholder="Elija Empleado"></select>
                            </div>
                        </div>
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
                                        <th>Precio</th>
                                        <th>SubTotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_detalleorden">
                                    <tr class="detalle_orden">
                                        <td class="item">1</td>
                                        <td>
                                            <select id="oc_materiales" class="form-control oc_materiales">
                                                <option>Material</option>
                                                <option>Material</option>
                                                <option>Material</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control cant_material">
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
                                        <td colspan="3"></td>
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
                                <label for="inm_id">Comentario</label>
                                <textarea class="form-control" id="oc_desc">

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

<script src="<?php echo base_url().'assets/adminjs/orden_compra.js';?>"></script>

