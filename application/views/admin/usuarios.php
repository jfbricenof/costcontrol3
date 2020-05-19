<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Usuarios
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Usuarios</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#empleados" data-toggle="tab">Usuarios</a></li>
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
                                                <th>Empleado</th>
                                                <th>Tipo</th>
                                                <th>email</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_empleados">
                                            <?php foreach ($usuarios as $usuario): ?>
                                                <tr>
                                                    <td class="td_id_empleado"><?php echo $usuario->id_empleado; ?>
                                                    </td>
                                                    <td class="td_tipo"><?php echo $usuario->tipo; ?></td>
                                                    <td class="td_email"><?php echo $usuario->email; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <button class="btn btn-sm btn-default editar_usuario" data-url="<?php echo base_url(); ?>admin/usuarios/editar_usuario/"  data-id_usuario="<?php echo $usuario->id_usuario;?>" title="Editar" data-toggle="modal" data-target="#modal-edit_usuario"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default eliminar_usuario" data-url="<?php echo base_url(); ?>admin/usuarios/borrar_usuario/<?php echo $usuario->id_usuario; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
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
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#md-nuevo-usuario">
                                    <span class="fa fa-plus"></span> Agregar Usuario
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
<div class="modal fade" id="modal-edit_usuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Usuario</h4>
                </div>
                <form role="form" id="edit_usuario" action="" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="usuario_tipo_edit">Tipo</label>
                                            <input name="usuario_tipo_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="usuario_email_edit">Email</label>
                                            <input name="usuario_email_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="usuario_pw_edit">Pw</label>
                                            <input name="usuario_pw_edit" type="text" class="form-control">
                                            <input type="hidden" name="id_usuario">
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
<!-- Modal Agregar usuario -->
<div class="modal fade" id="md-nuevo-usuario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Usuario</h4>
            </div>
            <form role="form" id="add_usuario" action="<?php echo base_url().'admin/usuarios/add_usuario';?>" method="post">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="empleado_id">Empleado</label>
                                            <select name="empleado_id" type="number" class="form-control">
                                                <?php foreach ($empleados as $item): ?>
                                                    <option value="<?php echo $item->id_empleado; ?>"><?php echo $item->nombre.' '.
                                                    $item->apellido; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="usuario_tipo">Tipo</label>
                                            <select name="usuario_tipo" type="text" class="form-control">
                                                <option value="Supervisor">Supervisor
                                                </option>
                                                <option value="Jefe de Compras">Jefe de Compras
                                                </option>
                                                <option value="Almacenista">Almacenista
                                                </option>
                                                <option value="Ejecutivo">Ejecutivo
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="usuario_email">Email</label>
                                            <input name="usuario_email" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="usuario_pw">Contraseña</label>
                                            <input name="usuario_pw" type="text" class="form-control">
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


<script src="<?php echo base_url().'assets/adminjs/usuarios.js';?>"></script>

