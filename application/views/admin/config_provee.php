<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Proveedores
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">Proveedores</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#proves" data-toggle="tab">PROVEEDOR</a></li>
                    <!-- <li><a href="#rubros" data-toggle="tab">Rubros</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="proves">
                        <!-- tabla proveedores-->
                        <div class="box box-default">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Razon Social</th>
                                                <th>NIT</th>
                                                <th>Nombre Comercial</th>
                                                <th>Correo Electronico</th>
                                                <th>Dirección</th>
                                                <th>Ciudad</th>
                                                <th>Telefonos</th>
                                                <th>Celular</th>
                                                <th>Contacto</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_proves">
                                            <?php foreach ($proves as $provee): ?>
                                                <tr>
                                                    <td class="td_razon"><?php echo $provee->razon; ?></td>
                                                    <td class="td_nit"><?php echo $provee->nit; ?></td>
                                                    <td class="td_ncomercial"><?php echo $provee->ncomercial; ?></td>
                                                    <td class="td_correo"><?php echo $provee->correo; ?></td>
                                                    <td class="td_direccion"><?php echo $provee->direccion; ?></td>
                                                    <td class="td_ciudad"><?php echo $provee->ciudad; ?></td>
                                                    <td class="td_tel"><?php echo $provee->tel; ?></td>
                                                    <td class="td_cel"><?php echo $provee->cel; ?></td>
                                                    <td class="td_contacto"><?php echo $provee->contacto; ?></td>
                                                    <td>
                                                        <div class="pull-right">
                                                            <button class="btn btn-sm btn-default editar_provee" data-url="<?php echo base_url(); ?>admin/config_provee/edit_provee/"  data-id_provee="<?php echo $provee->id_provee;?>" title="Editar" data-toggle="modal" data-target="#modal-edit_provee"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default eliminar_provee" data-url="<?php echo base_url(); ?>admin/config_provee/borrar_provee/<?php echo $provee->id_provee; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
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
                                <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#md-nuevo-provee">
                                    <span class="fa fa-plus"></span> Agregar Proveedor
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

<div class="modal fade" id="modal-edit_provee">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Proveedor</h4>
                </div>
                <form role="form" id="edit_provee" action="" method="post">
                    <div class="modal-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_razon_edit">Razón Social</label>
                                            <input name="provee_razon_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_nit_edit">NIT</label>
                                            <input name="provee_nit_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_ncomercial_edit">Nombre Comercial</label>
                                            <input name="provee_ncomercial_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_correo_edit">Correo Electrónico</label>
                                            <input name="provee_correo_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_direccion_edit">Dirección</label>
                                            <input name="provee_direccion_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_ciudad_edit">Ciudad</label>
                                            <input name="provee_ciudad_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_tel_edit">Teléfonos</label>
                                            <input name="provee_tel_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_cel_edit">Celular</label>
                                            <input name="provee_cel_edit" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_contacto_edit">Contacto</label>
                                            <input name="provee_contacto_edit" type="text" class="form-control">
                                            <input type="hidden" name="id_provee">
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
<!-- Modal Agregar provee -->
<div class="modal fade" id="md-nuevo-provee">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Proveedor</h4>
            </div>
            <form role="form" id="add_provee" action="<?php echo base_url().'admin/config_provee/add_provee';?>" method="post">
                <div class="modal-body">
                    <div class="row ">
                        <div class="col-md-12">
                                <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                            <div class="form-group ">
                                                <label for="provee_razon">Razón Social</label>
                                                <input name="provee_razon" type="text" class="form-control">
                                            </div>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_nit">NIT</label>
                                            <input name="provee_nit" type="text" class="form-control">
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_ncomercial">Nombre Comercial</label>
                                            <input name="provee_ncomercial" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_correo">Correo Electrónico</label>
                                            <input name="provee_correo" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_direccion">Dirección</label>
                                            <input name="provee_direccion" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_ciudad">Ciudad</label>
                                            <input name="provee_ciudad" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_tel">Teléfonos</label>
                                            <input name="provee_tel" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_cel">Celular</label>
                                            <input name="provee_cel" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                                        <div class="form-group ">
                                            <label for="provee_contacto">Contacto</label>
                                            <input name="provee_contacto" type="text" class="form-control">
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

<script src="<?php echo base_url().'assets/adminjs/config_provee.js';?>"></script>

