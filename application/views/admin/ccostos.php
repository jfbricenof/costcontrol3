<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Centros de Costo
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Centros de Costo</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#centros" data-toggle="tab">Centros de Costo</a></li>
                    <!-- <li><a href="#rubros" data-toggle="tab">Rubros</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="centros">
                        <!-- tabla CentrosCosto-->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Dirección</th>
                                                <th>Responsable</th>
                                                <th>Telefono</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_centros">
                                            <?php foreach ($centros as $centro): ?>
                                                <tr>
                                                    <td class="td_nombre"><?php echo $centro->nombre; ?></td>
                                                    <td class="td_direccion"><?php echo $centro->direccion; ?></td>
                                                    <td class="td_responsable"><?php echo $centro->responsable; ?></td>
                                                    <td class="td_tel"><?php echo $centro->tel; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <button class="btn btn-sm btn-default editar_centro" data-url="<?php echo base_url(); ?>admin/ccostos/editar_centro/"  data-id_centro="<?php echo $centro->id_ccostos;?>" title="Editar" data-toggle="modal" data-target="#modal-editar_centro"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default eliminar_centro" data-url="<?php echo base_url(); ?>admin/ccostos/borrar_centro/<?php echo $centro->id_ccostos; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
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
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#md-nuevo-centro">
                                    <span class="fa fa-plus"></span> Agregar Centro de Costos
                                </button>
                            </div>
                        </div>

                        <!-- /.fin tabla Centros costos -->
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

<div class="modal fade" id="modal-editar_centro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar CentroCostos</h4>
                </div>
                <form role="form" id="editar_centro" action="" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="centro_nombre_edit">Nombre</label>
                                            <input name="centro_nombre_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="centro_direccion_edit">Direccion</label>
                                            <input name="centro_direccion_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="centro_responsable_edit">Responsable</label>
                                            <input name="centro_responsable_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="centro_tel_edit">Telefono</label>
                                            <input name="centro_tel_edit" type="text" class="form-control">
                                            <input type="hidden" name="id_ccostos">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- Modal Agregar centro -->
<div class="modal fade" id="md-nuevo-centro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Centro Costos</h4>
            </div>
            <form role="form" id="add_centro" action="<?php echo base_url().'admin/ccostos/add_centro';?>" method="post">
                <div class="modal-body">
                    <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="centro_nombre">Nombre</label>
                                            <input name="centro_nombre" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="centro_direccion">Direccion</label>
                                            <input name="centro_direccion" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="centro_responsable">Responsable</label>
                                            <input name="centro_responsable" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="centro_tel">Telefono</label>
                                            <input name="centro_tel" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url().'assets/adminjs/ccostos.js';?>"></script>

