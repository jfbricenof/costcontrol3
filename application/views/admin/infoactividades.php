<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Reporte Actividades
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Reporte Actividades</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#actividades" data-toggle="tab">Reporte Actividades</a></li>
                    <!-- <li><a href="#rubros" data-toggle="tab">Rubros</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="actividades">
                        <!-- tabla actividades-->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th class="text-right">Costo</th>
                                                <th class="text-right">Valor Presupuestado</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_actividades">
                                            <?php foreach ($actividades as $actividad): ?>
                                                <tr>
                                                    <td class="td_nombre"><?php echo $actividad->nombre; ?></td>
                                                    <td class="text-right"><?php echo number_format($actividad->costo, 2, ",", "."); ?></td>
                                                    <td class="text-right"><?php echo number_format($actividad->presupuesto, 2, ",", "."); ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->

                        </div>

                        <!-- /.fin tabla proveedores -->
                    </div>

                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>


<script src="<?php echo base_url().'assets/adminjs/actividad.js';?>"></script>

