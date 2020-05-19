<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ordenes Compra Pendientes
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Ordenes de Compra Pendientes</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#ordenes" data-toggle="tab">ORDENES DE COMPRA</a></li>

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
                                                <th># Orden Compra</th>
                                                <th>Fecha</th>
                                                <th>Proveedor</th>
                                                <th>Requisición</th>
                                                <th class="text-right">Valor Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_ordenes">
                                            <?php foreach ($ordenes as $orden): ?>
                                                <tr>
                                                    <td class="td_id_OrdenCompra"><?php echo $orden->id_OrdenCompra; ?></td>
                                                    <td class="td_fecha"><?php echo $orden->fecha; ?></td>
                                                    <td class="td_id_provee"><?php echo $orden->razon; ?></td>
                                                    <td class="td_requisicion"><?php echo $orden->requisicion; ?></td>
                                                    <td class="td_total text-right"><?php
                                                    setlocale(LC_MONETARY, 'es_CO');
                                                    echo money_format('%!i', $orden->total) . "\n"; ?>
                                                    </td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <a href="<?php echo base_url().'admin/entradas/nueva_entrada/'.$orden->id_OrdenCompra; ?>" class="btn btn-sm btn-default anular_orden" data-url="" title="Ver">Dar Entrada</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
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




