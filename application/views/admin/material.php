<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Materiales y Servicios
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Materiales y Servicios</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#materiales" data-toggle="tab">MATERIALES</a></li>
                    <li><a href="#servicios" data-toggle="tab">SERVICIOS</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="materiales">
                        <!-- tabla materiales-->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Unidad</th>
                                                <th>Tipo</th>
                                                <th class="text-right">Ultimo $</th>
                                                <th class="text-right">Cant</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_materiales">
                                            <?php foreach ($materiales as $material): ?>
                                                <tr>
                                                    <td class="td_nombre"><?php echo $material->nombre; ?></td>
                                                    <td class="td_unidad"><?php echo $material->unidad; ?></td>
                                                    <td class="td_tipo"><?php echo $material->tipo; ?></td>
                                                    <td class="td_precio text-right"><?php echo number_format($material->precio, 2, ",", "."); ?></td>
                                                    <td class="td_cantidad text-right" ><?php echo $material->cantidad; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <button class="btn btn-sm btn-default editar_material" data-url="<?php echo base_url(); ?>admin/material/edit_material/"  data-id_material="<?php echo $material->id_material;?>" title="Editar" data-toggle="modal" data-target="#modal-edit_material"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default eliminar_material" data-url="<?php echo base_url(); ?>admin/material/borrar_material/<?php echo $material->id_material; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
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
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#md-nuevo-material">
                                    <span class="fa fa-plus"></span> Agregar Material
                                </button>
                            </div>
                        </div>
                        <!-- /.box-box default -->
                    </div>
                    <!-- /.fin tabla materiales -->

                    <div class="tab-pane" id="servicios">
                        <!-- tabla servicioes-->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Unidad</th>
                                                <th>Tipo</th>
                                                <th>Precio</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tbody_servicios">
                                            <?php foreach ($servicios as $servicio): ?>
                                                <tr>
                                                    <td class="td_nombre"><?php echo $servicio->nombre; ?></td>
                                                    <td class="td_unidad"><?php echo $servicio->unidad; ?></td>
                                                    <td class="td_tipo"><?php echo $servicio->tipo; ?></td>
                                                    <td class="td_precio"><?php echo $servicio->precio; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <button class="btn btn-sm btn-default editar_servicio" data-url="<?php echo base_url(); ?>admin/servicio/edit_servicio/"  data-id_servicio="<?php echo $servicio->id_servicio;?>" title="Editar" data-toggle="modal" data-target="#modal-edit_servicio"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default eliminar_servicio" data-url="<?php echo base_url(); ?>admin/servicio/borrar_servicio/<?php echo $servicio->id_servicio; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
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
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#md-nuevo-servicio">
                                    <span class="fa fa-plus"></span> Agregar Servicio
                                </button>
                            </div>
                        </div>
                        <!-- /.box-box default -->
                    </div>
                    <!-- /.fin tabla servicio -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- Modal Editar material -->
<div class="modal fade" id="modal-edit_material">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Material</h4>
                </div>
                <form role="form" id="edit_material" action="" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="material_nombre_edit">Descripción</label>
                                            <input name="material_nombre_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="material_unidad_edit">Unidad</label>
                                            <input name="material_unidad_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="material_tipo_edit">Tipo</label>
                                            <input name="material_tipo_edit" type="text" class="form-control">
                                            <input type="hidden" name="id_material">
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
<!-- Modal Agregar material -->
<div class="modal fade" id="md-nuevo-material">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Material</h4>
            </div>
            <form role="form" id="add_material" action="<?php echo base_url().'admin/material/add_material';?>" method="post">
                <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="material_nombre">Descripción</label>
                                            <input name="material_nombre" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="material_unidad">Unidad</label>
                                            <input name="material_unidad" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="material_tipo">Tipo</label>
                                            <input name="material_tipo" type="text" class="form-control">
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
<!-- Modal Editar servicio -->
<div class="modal fade" id="modal-edit_servicio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Servicio</h4>
                </div>
                <form role="form" id="edit_servicio" action="" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="servicio_nombre_edit">Descripción</label>
                                            <input name="servicio_nombre_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="servicio_unidad_edit">Unidad</label>
                                            <input name="servicio_unidad_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="servicio_tipo_edit">Tipo</label>
                                            <input name="servicio_tipo_edit" type="text" class="form-control">
                                            <input type="hidden" name="id_servicio">
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
<!-- Modal Agregar servicio -->
<div class="modal fade" id="md-nuevo-servicio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Servicio</h4>
            </div>
            <form role="form" id="add_servicio" action="<?php echo base_url().'admin/servicio/add_servicio';?>" method="post">
                <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="servicio_nombre">Descripción</label>
                                            <input name="servicio_nombre" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="servicio_unidad">Unidad</label>
                                            <input name="servicio_unidad" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="servicio_tipo">Tipo</label>
                                            <input name="servicio_tipo" type="text" class="form-control">
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

<script src="<?php echo base_url().'assets/adminjs/material.js';?>"></script>

