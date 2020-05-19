<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Reporte Materiales
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Reporte Materiales</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Material</th>
                                <th class="text-right">Cantidad</th>
                                <th>Actividad</th>
                                <th class="text-right">Valor Gastado</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_kardexes">
                            <?php foreach ($info_materiales as $info): ?>
                                <tr>
                                    <td ><?php echo $info->nombre; ?></td>
                                    <td class="text-right"><?php echo $info->cant; ?></td>
                                    <td ><?php echo $info->Actividad; ?></td>
                                    <td class="text-right"><?php echo number_format($info->gastado, 2, ",", "."); ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script src="<?php echo base_url().'assets/adminjs/kardex.js';?>"></script>




