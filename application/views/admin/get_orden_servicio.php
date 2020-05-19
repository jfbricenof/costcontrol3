<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ver Orden de Servicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Orden de Servicio</a></li>
        <li class="active">Ver Orden Servicio</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <section class="invoice">
            <!-- title row -->

            <!-- info row -->
            <div class="row invoice-info">
                <table class="table">
                    <tr>
                        <th>Proveedor</th>
                        <th>Fecha Orden</th>
                        <th>Condición Pago:</th>
                        <th>Recibe: </th>
                    </tr>
                    <tr>
                        <td><?php echo $info[0]->razon; ?></td>
                        <td><?php echo $info[0]->fecha; ?></td>
                        <td><?php echo $info[0]->cond_pago; ?></td>
                        <th><?php echo $info[0]->nombre." ".$info[0]->apellido; ?> </th>
                    </tr>
                </table>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Servicio</th>
                                <th class="text-right">Precio Unitario</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count = 0; ?>
                        <?php foreach ($detalle as $item):
                            $count++; ?>
                            <tr>
                                <td ><?php echo $count; ?></td>
                                <td ><?php echo $item->cant_servicio; ?></td>
                                <td ><?php echo $item->unidad; ?></td>
                                <td ><?php echo $item->nombre; ?></td>
                                <td class="text-right"><?php echo number_format($item->precio_unit, 2, ",", "."); ?></td>
                                <td class="text-right"><?php echo number_format($item->subtotal, 2, ",", "."); ?></td>

                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                    <p class="lead">Observación:</p>

                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        <?php echo $info[0]->observacion; ?>
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead">Requerido Para: <?php echo $info[0]->fecha_fin; ?></p>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$ <?php echo number_format($info[0]->subtotal, 2, ",", "."); ?></td>
                            </tr><!-- 
                            <tr>
                                <th>IVA <?php echo $info[0]->nombre_iva; ?> (<?php echo $info[0]->porcentaje_iva; ?> %)</th>
                                <td>$ <?php echo number_format($info[0]->total, 2, ",", "."); ?></td>
                            </tr> -->
                            <tr>
                                <th>Total:</th>
                                <td>$ <?php echo number_format($info[0]->total, 2, ",", "."); ?></td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Generate PDF
                    </button>
                </div>
            </div>
        </section>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

