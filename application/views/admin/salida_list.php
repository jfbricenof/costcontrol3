<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Salidas de Almacen
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Salidas de Almacen</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#salidas" data-toggle="tab">Salidas de Almacén</a></li>

                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="salidas">
                        <!-- tabla salidas -->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th># Salida</th>
                                                <th>Fecha</th>
                                                <th>Vale</th>
                                                <th>Contratista</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_salidas">
                                            <?php foreach ($salidas as $salida): ?>
                                                <tr>
                                                    <td class="td_id_salida"><?php echo $salida->id_salida; ?></td>
                                                    <td class="td_fecha"><?php echo $salida->fecha; ?></td>
                                                    <td class="td_vale"><?php echo $salida->vale; ?></td>
                                                    <td class="td_contratista"><?php echo $salida->contratista; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <a href="<?php echo base_url().'admin/salidas/consultar/'.$salida->id_salida; ?>" class="btn btn-sm btn-default ver_salida" data-url="" title="Ver"><span class="fa fa-eye"></span></a>
                                                            <button class="btn btn-sm btn-default anular_salida" data-url="" title="Anular"><span class="fa fa-times"></span></button>
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
                                <a class="btn btn-success pull-right" href="<?php echo base_url().'admin/salidas/nueva_salida';?>" role="button">Crear Salida</a>
                            </div>
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




