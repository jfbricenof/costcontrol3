<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Reintegros de Almacen
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Reintegros de Almacen</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#reintegros" data-toggle="tab">Reintegros de Almacén</a></li>

                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="reintegros">
                        <!-- tabla reintegros -->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th># Reintegro</th>
                                                <th>Fecha</th>
                                                <th>Contratista</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_reintegros">
                                            <?php foreach ($reintegros as $reintegro): ?>
                                                <tr>
                                                    <td class="td_id_reintegro"><?php echo $reintegro->id_reintegro; ?></td>
                                                    <td class="td_fecha"><?php echo $reintegro->fecha; ?></td>
                                                    <td class="td_contratista"><?php echo $reintegro->contratista; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <a href="<?php echo base_url().'admin/reintegro/consultar/'.$reintegro->id_reintegro; ?>" class="btn btn-sm btn-default ver_reintegro" data-url="" title="Ver"><span class="fa fa-eye"></span></a>
                                                            <button class="btn btn-sm btn-default anular_reintegro" data-url="" title="Anular"><span class="fa fa-times"></span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a class="btn btn-success pull-right" href="<?php echo base_url().'admin/reintegro/nueva_reintegro';?>" role="button">Crear Reintegro</a>
                            </div>
                        </div>

                        <!-- /.fin tabla reintegros -->
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




