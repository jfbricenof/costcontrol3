<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ver Reintegro
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Reintegro</a></li>
        <li class="active">Ver Reintegro</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <section class="invoice">
            <!-- title row -->
            
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-md-12">
                     <table class="table">
                        <tr>
                            <th>Contratista</th>
                            <th>Fecha Reintegro</th>
                        </tr>
                        <tr>
                            <td><?php echo $info[0]->contratista; ?></td>
                            <td><?php echo $info[0]->fecha; ?></td>
                        </tr>
                    </table>
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
      
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
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

