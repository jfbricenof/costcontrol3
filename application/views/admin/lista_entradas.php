<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Entradas de Almacen
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Entradas de Almacen</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#entradas" data-toggle="tab">Entradas de Almacén</a></li>
                    <div class="box-footer clearfix">
                        <a class="btn btn-success pull-right" href="<?php echo base_url().'admin/entradas';?>" role="button">Crear Entrada</a>
                    </div>

                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="entradas">
                        <!-- tabla entradas -->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th># Entrada</th>
                                                <th>Fecha</th>
                                                <th>Orden Compra</th>
                                                <th class="text-right">Total</th>
                                                <th>Remision</th>
                                                <th>Factura</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_entradas">
                                            <?php foreach ($entradas as $entrada): ?>
                                                <tr>
                                                    <td class="td_id_entrada"><?php echo $entrada->id_entrada; ?></td>
                                                    <td class="td_fecha"><?php echo $entrada->fecha; ?></td>
                                                    <td class="td_id_OrdenCompra"><?php echo $entrada->id_OrdenCompra; ?></td>
                                                    <td class="text-right"><?php echo number_format($entrada->total, 2, ",", "."); ?></td>
                                                    <td class="td_remision"><?php echo $entrada->remision; ?></td>
                                                    <td class="td_factura"><?php echo $entrada->factura; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <a href="<?php echo base_url().'admin/entradas/consultar/'.$entrada->id_entrada; ?>" class="btn btn-sm btn-default ver_entrada" data-url="" title="Ver"><span class="fa fa-eye"></span></a>
                                                            <button class="btn btn-sm btn-default anular_entrada" data-url="" title="Anular"><span class="fa fa-times"></span></button>
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

                        <!-- /.fin tabla salidas -->
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




