<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Empleados
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Empleados</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#empleados" data-toggle="tab">Empleados</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="empleados">
                        <!-- tabla empleados-->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover">
                                        <thead>
                                            <tr>
                                                <th>Identificacion</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Telefono</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_empleados">
                                            <?php foreach ($empleados as $empleado): ?>
                                                <tr>
                                                    <td class="td_id_empleado"><?php echo $empleado->id_empleado; ?></td>
                                                    <td class="td_nombre"><?php echo $empleado->nombre; ?></td>
                                                    <td class="td_apellido"><?php echo $empleado->apellido; ?></td>
                                                    <td class="td_telefono"><?php echo $empleado->telefono; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <button class="btn btn-sm btn-default editar_empleado" data-url="<?php echo base_url(); ?>admin/config_empleado/edit_empleado/"  data-id_empleado="<?php echo $empleado->id_empleado;?>" title="Editar" data-toggle="modal" data-target="#modal-edit_empleado"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default eliminar_empleado" data-url="<?php echo base_url(); ?>admin/config_empleado/borrar_empleado/<?php echo $empleado->id_empleado; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
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
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#md-nuevo-empleado">
                                    <span class="fa fa-plus"></span> Agregar Empleado
                                </button>
                            </div>
                        </div>

                        <!-- /.fin tabla empleados -->
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
<!-- Modal Editar empleado -->
<div class="modal fade" id="modal-edit_empleado">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Empleado</h4>
                </div>
                <form role="form" id="edit_empleado" action="" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="empleado_nombre_edit">Nombre</label>
                                            <input name="empleado_nombre_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="empleado_apellido_edit">Apellido</label>
                                            <input name="empleado_apellido_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="empleado_telefono_edit">Telefono</label>
                                            <input name="empleado_telefono_edit" type="text" class="form-control">
                                            <input type="hidden" name="id_empleado">
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
<!-- Modal Agregar empleado -->
<div class="modal fade" id="md-nuevo-empleado">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Empleado</h4>
            </div>
            <form role="form" id="add_empleado" action="<?php echo base_url().'admin/config_empleado/add_empleado';?>" method="post">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="empleado_id">Identificación</label>
                                            <input name="empleado_id" type="number" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="empleado_nombre">Nombre</label>
                                            <input name="empleado_nombre" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="empleado_apellido">Apellido</label>
                                            <input name="empleado_apellido" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="empleado_telefono">Telefono</label>
                                            <input name="empleado_telefono" type="text" class="form-control">
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


<script src="<?php echo base_url().'assets/adminjs/config_empleado.js';?>"></script>

