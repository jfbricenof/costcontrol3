<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ordenes de Servicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Ordenes de Servicio</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#ordenes" data-toggle="tab">ORDENES DE SERVICIO</a></li>
                    <div class="box-footer clearfix">
                        <a class="btn btn-success pull-right" href="<?php echo base_url().'admin/orden_servicio/nueva_orden';?>" role="button">Crear Orden de Servicio</a>
                    </div>

                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="ordenes">
                        <!-- tabla ordenes -->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th># Orden Servicio</th>
                                                <th>Fecha</th>
                                                <th>Proveedor</th>
                                                <th class="text-right">Valor Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_ordenes">
                                            <?php foreach ($ordenes as $orden): ?>
                                                <tr>
                                                    <td class="td_id_OrdenServicio"><?php echo $orden->id_OrdenServicio; ?></td>
                                                    <td class="td_fecha"><?php echo $orden->fecha; ?></td>
                                                    <td class="td_id_provee"><?php echo $orden->razon; ?></td>
                                                    <td class="td_total text-right"><?php
                                                    setlocale(LC_MONETARY, 'es_CO');
                                                    echo money_format('%!i', $orden->total) . "\n"; ?>
                                                    </td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <a href="<?php echo base_url().'admin/orden_servicio/consultar/'.$orden->id_OrdenServicio; ?>" class="btn btn-sm btn-default ver_orden" data-url="" title="Ver"><span class="fa fa-eye"></span></a>
                                                            <button class="btn btn-sm btn-default anular_orden" data-url="" title="Anular"><span class="fa fa-times"></span></button>
                                                            <button class="btn btn-sm btn-default duplicar_orden" data-url="" title="Duplicar"><span class="fa fa-clone"></span></button>
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

                        </div>

                        <!-- /.fin tabla ordenes -->
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




