<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Devoluciónes
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Devoluciones</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#devoluciones" data-toggle="tab">DEVOLUCIONES</a></li>

                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="devoluciones">
                        <!-- tabla devoluciones -->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th># Devolucion</th>
                                                <th>Fecha</th>
                                                <th>Proveedor</th>
                                                <th class="text-right">Valor Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_devoluciones">
                                            <?php foreach ($devoluciones as $devolucion): ?>
                                                <tr>
                                                    <td class="td_id_devolucion"><?php echo $devolucion->id_devolucion; ?></td>
                                                    <td class="td_fecha"><?php echo $devolucion->fecha; ?></td>
                                                    <td class="td_id_provee"><?php echo $devolucion->razon; ?></td>
                                                    <td class="td_total text-right"><?php
                                                    setlocale(LC_MONETARY, 'es_CO');
                                                    echo money_format('%!i', $devolucion->total) . "\n"; ?>
                                                    </td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <a href="<?php echo base_url().'admin/devolucion/consultar/'.$devolucion->id_devolucion; ?>" class="btn btn-sm btn-default anular_devolucion" data-url="" title="Ver"><span class="fa fa-eye"></span></a>
                                                            <button class="btn btn-sm btn-default anular_devolucion" data-url="" title="Anular"><span class="fa fa-times"></span></button>
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
                                <a class="btn btn-success pull-right" href="<?php echo base_url().'admin/devolucion/nueva_devolucion';?>" role="button">Crear Devolución</a>
                            </div>
                        </div>

                        <!-- /.fin tabla devoluciones -->
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




