<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ingresar Entrada
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Entrada</a></li>
        <li class="active">Crea Entrada</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <section class="invoice">
            <div class="row invoice-info">
                <div class="col-md-12">
                     <table class="table">
                        <tr>
                            <th>Proveedor</th>
                            <th>Requisición</th>
                            <th>Fecha Orden</th>
                            <th>Fecha Requisición</th>
                            <th>Condición Pago:</th>
                            <th>Recibe: </th>
                        </tr>
                        <tr>
                            <td><?php echo $info[0]->razon; ?></td>
                            <td><?php echo $info[0]->requisicion; ?></td>
                            <td><?php echo $info[0]->fecha; ?></td>
                            <td><?php echo $info[0]->fecha_requi; ?></td>
                            <td><?php echo $info[0]->cond_pago; ?></td>
                            <th><?php echo $info[0]->nombre." ".$info[0]->apellido; ?> </th>
                        </tr>
                    </table>
                </div>
            </div>


            <!-- /.row -->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="en_iva">Orden de Compra N. </label>
                        <input readonly id="en_id_OrdenCompra" type="text" class="form-control" placeholder="..." value="<?echo $info[0]->id_OrdenCompra; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="en_remision">Remisión</label>
                        <input id="en_remision" type="text" class="form-control" placeholder="Ingrese N. Remisión">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="en_factura">Factura</label>
                        <input id="en_factura" type="text" class="form-control" placeholder="Ingrese N. Factura">
                    </div>
                </div>
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped ">
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
                        <tbody>
                        <?php $count = 0; ?>
                        <?php foreach ($detalle as $item):
                            $count++; ?>
                            <tr class="detalle_entrada">
                                <td class="item"><?php echo $count; ?></td>
                                <td>
                                    <input data-id="<?php echo $item->id_DetalleOrden; ?>" type="text" class="form-control orden" value="<?php echo $item->nombre; ?>">
                                </td>
                                <td>
                                    <input type="number" class="form-control cant_material" max="<?php echo $item->cant_material; ?>" value="<?php echo $item->cant_material; ?>">
                                    <input type="hidden" class="cant_init" value="<?php echo $item->cant_material; ?>">
                                </td>
                                <td>
                                    <select id="en_actividades" class="form-control en_actividades">
                                        <option>Actividad</option>
                                    </select>
                                </td>
                                <td>
                                    <input readonly type="number" class="form-control text-right precio_material" value="<?php echo $item->precio_unit; ?>">
                                </td>
                                <td>
                                    <input type="number" class="form-control text-right sub_total_mat" name="" value="<?php echo $item->subtotal; ?>" readonly>
                                </td>
                                <td class="detalle_acciones">
                                    <button class="btn del_detalle"> <i class="fa fa-trash"></i> </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"></td>
                                <th class="text-right">TOTAL:</th>
                                <td><input type="number" class="form-control total1 text-right" value="<?php echo $info[0]->subtotal; ?>" readonly></td>
                            </tr>
<!--                             <tr>
                                <td colspan="4"></td>
                                <th class="text-right"> IVA:</th>
                                <td><input type="number" class="form-control totaliva text-right" value="<?php echo $info[0]->total - $info[0]->subtotal; ?>" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <th class="text-right">GRAN TOTAL:</th>
                                <td><input type="number" class="form-control grantotal text-right" value="<?php echo $info[0]->total; ?>" readonly></td>
                            </tr> -->
                        </tfoot>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="inm_id">Comentario</label>
                        <textarea class="form-control" id="en_desc">

                        </textarea>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <button style="margin-top: 20px" id="ingresar-entrada" class="btn btn-success btn-lg ">Ingresar Entrada</button>
                </div>
            </div>
        </section>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<script src="<?php echo base_url().'assets/adminjs/entrada.js';?>"></script>

