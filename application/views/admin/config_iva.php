<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Configuración de IVA
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Configuración de IVA</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#ivas" data-toggle="tab">IVA</a></li>
                    <!-- <li><a href="#rubros" data-toggle="tab">Rubros</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="ivas">
                        <!-- tabla tarifas-->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre IVA</th>
                                                <th>Porcentaje</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_ivas">
                                            <?php foreach ($ivas as $iva): ?>
                                                <tr>
                                                    <td class="td_nombre_iva"><?php echo $iva->nombre_iva; ?></td>
                                                    <td class="td_porcentaje"><?php echo $iva->porcentaje_iva; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <button class="btn btn-sm btn-default editar_iva" data-url="<?php echo base_url(); ?>admin/config_iva/edit_iva/"  data-id_iva="<?php echo $iva->id_iva;?>" title="Editar" data-toggle="modal" data-target="#modal-edit_iva"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default eliminar_iva" data-url="<?php echo base_url(); ?>admin/config_iva/borrar_iva/<?php echo $iva->id_iva; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
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
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#md-nuevo-iva">
                                    <span class="fa fa-plus"></span> Agregar IVA
                                </button>
                            </div>
                        </div>

                        <!-- /.fin tabla tarifas -->
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

<div class="modal fade" id="modal-edit_iva">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar IVA</h4>
                </div>
                <form role="form" id="edit_iva" action="" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="iva_nombre_edit">Nombre IVA</label>
                                            <input name="iva_nombre_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="iva_porcentaje_edit">Porcentaje (%)</label>
                                            <input name="iva_porcentaje_edit" type="number" class="form-control">
                                            <input type="hidden" name="id_iva">
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
<!-- Modal Agregar Rubro -->
<div class="modal fade" id="md-nuevo-iva">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar IVA</h4>
            </div>
            <form role="form" id="add_iva" action="<?php echo base_url().'admin/config_iva/add_iva';?>" method="post">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                    <div class="form-group ">
                                        <label for="iva_nombre">Nombre IVA</label>
                                        <input name="iva_nombre" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                    <div class="form-group ">
                                        <label for="iva_porcentaje">Porcentaje (%)</label>
                                        <input name="iva_porcentaje" type="number" class="form-control">
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
<!-- Modal Editar Rubro -->
<div class="modal fade" id="md-edit-rubro">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Rubro</h4>
            </div>
            <form role="form" id="edit_rubro" action="" method="post">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                    <div class="form-group ">
                                        <label for="edit_rub_nombre">Nombre</label>
                                        <input name="edit_rub_nombre" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                    <div class="form-group ">
                                        <label for="edit_rub_descripcion">Descripción</label>
                                        <textarea name="edit_rub_descripcion" type="text" class="form-control" value="" rows="2"></textarea>
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
<script src="<?php echo base_url().'assets/adminjs/config_iva.js';?>"></script>

