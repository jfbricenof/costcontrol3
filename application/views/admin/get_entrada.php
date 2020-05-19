<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Entrada de Almacén
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Entrada de Almacén</a></li>
        <li class="active">Ver Entrada de Almacén</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <section class="invoice">
            <!-- title row -->
            <div class="col-xs-5">
                <img alt="" src="<?php echo base_url().'/assets/dist/img/logo.png';?>" class="user-image"/>
                    <br>
                    QUALITY GROUP CONSTRUCTORES Y CIA EN C.S<br>
                    NIT. 901031711-1<br>
                    CRA. 26 N. 12-24 Alamos, Pereira<br>
                    3211515<br>

            </div>
            <div class="col-xs-5 col-xs-offset-2 text-right">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Entrada de Almacén</h3>
                        <h4><?php echo "No. ".$info[0]->id_entrada; ?></h4>
                    </div>
                        <h4 class="panel-body"><?php echo "Fecha: ".$info[0]->fecha; ?></h4>
                    </div>
            </div>

            <!-- info row -->

            <div class="row">
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Proyecto Requisitor: <b>  Nombre de la obra</b></h4>
                        </div>
                        <div class="panel-body">
                            <p><b>Remisión N.:  </b><?php echo $info[0]->remision; ?></p>
                            <p><b>Factura N.:  </b><?php echo $info[0]->factura; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5 col-xs-offset-1 text-left">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Proveedor : <a href="#"><?php echo $info[0]->razon; ?></a></h4>
                        </div>
                        <div class="panel-body">
                            <p><b>NIT: </b><?php echo $info[0]->nit; ?></p>
                            
                        </div>
                    </div>
                </div>
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
                                <th>Material</th>
                                <th>Actividad</th>
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
                                <td ><?php echo $item->cant_material; ?></td>
                                <td ><?php echo $item->unidad; ?></td>
                                <td ><?php echo $item->nombre; ?></td>
                                <td ><?php echo $item->id_actividad; ?></td>
                                <td class="text-right"><?php echo number_format($item->precio_unit_DetalleOrden, 2, ",", "."); ?></td>
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
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>Total:</th>
                                <td>$ <?php echo number_format($info[0]->total, 4, ",", "."); ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <button onclick="window.print()" type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Generar PDF
                    </button>
                </div>
            </div>
        </section>
    </div>
    <!-- /.row -->
   
</section>
<!-- /.content -->

