<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Actividades
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Activiades</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#actividades" data-toggle="tab">ACTIVIDADES</a></li>
                    <!-- <li><a href="#rubros" data-toggle="tab">Rubros</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="actividades">
                        <!-- tabla actividades-->
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
                                                <th>Costo</th>
                                                <th>Valor Presupuestado</th>
                                                <th>Observaciones</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_actividades">
                                            <?php foreach ($actividades as $actividad): ?>
                                                <tr>
                                                    <td class="td_nombre"><?php echo $actividad->nombre; ?></td>
                                                    <td class="td_costo"><?php echo $actividad->costo; ?></td>
                                                    <td class="td_presupuesto"><?php echo $actividad->presupuesto; ?></td>
                                                    <td class="td_observacion"><?php echo $actividad->observacion; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <button class="btn btn-sm btn-default editar_actividad" data-url="<?php echo base_url(); ?>admin/actividad/edit_actividad/"  data-id_actividad="<?php echo $actividad->id_actividad;?>" title="Editar" data-toggle="modal" data-target="#modal-edit_actividad"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default eliminar_actividad" data-url="<?php echo base_url(); ?>admin/actividad/borrar_actividad/<?php echo $actividad->id_actividad; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
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
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#md-nuevo-actividad">
                                    <span class="fa fa-plus"></span> Agregar Actividad
                                </button>
                            </div>
                        </div>

                        <!-- /.fin tabla proveedores -->
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

<div class="modal fade" id="modal-edit_actividad">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Actividad</h4>
                </div>
                <form role="form" id="edit_actividad" action="" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="actividad_nombre_edit">Descripción</label>
                                            <input name="actividad_nombre_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="actividad_presupuesto_edit">Valor Presupuestado</label>
                                            <input name="actividad_presupuesto_edit" type="int" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="actividad_observacion_edit">Observaciones</label>
                                            <input name="actividad_observacion_edit" type="text" class="form-control">
                                            <input type="hidden" name="id_actividad">
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
<!-- Modal Agregar actividad -->
<div class="modal fade" id="md-nuevo-actividad">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Actividad</h4>
            </div>
            <form role="form" id="add_actividad" action="<?php echo base_url().'admin/actividad/add_actividad';?>" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="actividad_nombre">Descripción</label>
                                            <input name="actividad_nombre" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="actividad_presupuesto">Valor Presupuestado</label>
                                            <input name="actividad_presupuesto" type="int" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="actividad_observacion">Observaciones</label>
                                            <input name="actividad_observacion" type="text" class="form-control">
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
<script src="<?php echo base_url().'assets/adminjs/actividad.js';?>"></script>

