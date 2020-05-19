<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Configuración General
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Configuración General</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-6">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>/assets/dist/img/logo.png" alt="User profile picture">

          <h3 class="profile-username text-center"><?php echo $info[0]->nombre; ?></h3>
          <p class="text-muted text-center"><?php echo $info[0]->pais; ?></p>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <strong><i class="fa fa-book margin-r-5"></i> NIT</strong>
              <p class="text-muted"><?php echo $info[0]->nit; ?></p>
            </li>
            <li class="list-group-item">
              <strong><i class="fa fa-map-marker margin-r-5"></i> Dirección</strong>
              <p class="text-muted"><?php echo $info[0]->direccion; ?></p>
            </li>
            <li class="list-group-item">
              <strong><i class="fa fa-globe margin-r-5"></i> Ciudad</strong>
              <p class="text-muted"><?php echo $info[0]->ciudad; ?></p>
            </li>
            <li class="list-group-item">
              <strong><i class="fa fa-phone margin-r-5"></i> Teléfonos</strong>
              <p><?php echo $info[0]->telefono; ?></p>
            </li>
            <li class="list-group-item">
              <strong><i class="fa fa-envelope margin-r-5"></i> Correo</strong>
              <p class="text-muted"><?php echo $info[0]->web; ?></p>
            </li>
          </ul>
          <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modal-empresa">
            Editar
          </button>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <!-- <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tipos_inmueble" data-toggle="tab">Tipos Inmuebles</a></li>
          <li><a href="#sectores" data-toggle="tab">Sectores</a></li>
          <li><a href="#servicios" data-toggle="tab">Servicios</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="tipos_inmueble">
            <div class="box box-default">
                <div class="box-header with-border">

                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin table-hover">
                            <thead>
                                <tr>
                                    <th class="col-xs-3 col-sm-3 col-md-3">Nombre</th>
                                    <th class="col-xs-7 col-sm-7 col-md-7">Descripción</th>
                                    <th class="col-xs-3 col-sm-2 col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_tipo_inm">
                                <?php foreach ($t_inmuebles as $tipo_inm): ?>
                                    <tr>
                                        <td class="td_nom_inm"><?php echo $tipo_inm->nombre; ?></td>
                                        <td class="td_descrip_inm"><?php echo $tipo_inm->descripcion; ?></td>
                                        <td>
                                            <div class="pull-right">
                                                <button class="btn btn-sm btn-default btn-editar_tipo_inm" data-idtipoinm="<?php echo base_url(); ?>admin/config_inmuebles/edit_tipo_inmueble/<?php echo $tipo_inm->id_tipo_inmueble; ?>" title="Editar" data-toggle="modal" data-target="#modal-edit_tipo_inmueble"><span class="fa fa-pencil"></span></button>
                                                <button class="btn btn-sm btn-default btn-eliminar_tipo_inm" data-idtipoinm="<?php echo base_url(); ?>admin/config_inmuebles/borrar_tipo_inmueble/<?php echo $tipo_inm->id_tipo_inmueble; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-add_tipo_inmueble">
                      <span class="fa fa-plus"></span> Agregar Tipo de Inmueble
                    </button>
                </div>
            </div>

          </div>
          <div class="tab-pane" id="sectores">

            <div class="box box-default">
                <div class="box-header with-border">

                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin table-hover">
                            <thead>
                                <tr>
                                    <th class="col-xs-3 col-sm-3 col-md-3">Nombre</th>
                                    <th class="col-xs-7 col-sm-7 col-md-7">Descripción</th>
                                    <th class="col-xs-2 col-sm-2 col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_sector">
                                <?php foreach ($sectores as $un_sector): ?>
                                    <tr>
                                        <td class="td_nom_sector"><?php echo $un_sector->nombre; ?></td>
                                        <td class="td_descrip_sector"><?php echo $un_sector->descripcion; ?></td>
                                        <td>
                                            <div class="pull-right">
                                                <button class="btn btn-sm btn-default btn-editar_sector" data-id_ruta="<?php echo base_url(); ?>admin/config_inmuebles/edit_sector/<?php echo $un_sector->id_sector; ?>" title="Editar" data-toggle="modal" data-target="#modal-edit_sector"><span class="fa fa-pencil"></span></button>
                                                <button class="btn btn-sm btn-default btn-eliminar_sector" data-id_ruta="<?php echo base_url(); ?>admin/config_inmuebles/borrar_sector/<?php echo $un_sector->id_sector; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-add_sector">
                      <span class="fa fa-plus"></span> Agregar Sector
                    </button>
                </div>
            </div>

          </div>

          <div class="tab-pane" id="servicios">
            <div class="box box-default ">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin table-hover">
                            <thead>
                                <tr>
                                    <th class="col-xs-3 col-sm-3 col-md-3">Nombre</th>
                                    <th class="col-xs-7 col-sm-7 col-md-7">Descripción</th>
                                    <th class="col-xs-2 col-sm-2 col-md-2"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody_servicio">
                                <?php foreach ($servicios as $un_servicio): ?>
                                    <tr>
                                        <td class="td_nom_servicio"><?php echo $un_servicio->nombre; ?></td>
                                        <td class="td_descrip_servicio"><?php echo $un_servicio->descripcion; ?></td>
                                        <td>
                                            <div class="pull-right">
                                                <button class="btn btn-sm btn-default btn-editar_servicio" data-id_ruta="<?php echo base_url(); ?>admin/config_inmuebles/edit_servicio/<?php echo $un_servicio->id_servicio; ?>" title="Editar" data-toggle="modal" data-target="#modal-edit_servicio"><span class="fa fa-pencil"></span></button>
                                                <button class="btn btn-sm btn-default btn-eliminar_servicio" data-id_ruta="<?php echo base_url(); ?>admin/config_inmuebles/borrar_servicio/<?php echo $un_servicio->id_servicio; ?>" title="Eliminar"><span class="fa fa-trash"></span></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-add_servicio">
                      <span class="fa fa-plus"></span> Agregar Servicio
                    </button>
                </div>
            </div>

          </div>

        </div>

      </div>
    </div> -->
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<!-- Modal Empresa -->
<div class="modal fade bs-example-modal-lg" id="modal-empresa">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Información de la Empresa</h4>
      </div>
      <form role="form" id="actualizar_empresa" action="<?php echo base_url().'admin/config_general/actualizar_empresa';?>" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group ">
                        <label for="nit_empresa">NIT</label>
                        <input name="nit_empresa" type="text" class="form-control" id="nit_empresa" value="<?php echo $info[0]->nit; ?>">
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="nombre_empresa">Nombre</label>
                        <input name="nombre_empresa" type="text" class="form-control" id="nombre_empresa" value="<?php echo $info[0]->nombre; ?>">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group ">
                        <label for="ciudad_empresa">Ciudad</label>
                        <input name="ciudad_empresa" type="text" class="form-control" id="ciudad_empresa" value="<?php echo $info[0]->ciudad; ?>">
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="dep_empresa">Departamento</label>
                        <input name="dep_empresa" type="mail" class="form-control" id="dep_empresa" value="<?php echo $info[0]->departamento; ?>">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group ">
                        <label for="tel_fijo_empresa">Teléfono</label>
                        <input name="tel_fijo_empresa" type="number" class="form-control" id="tel_fijo_empresa" value="<?php echo $info[0]->telefono; ?>">
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="web_empresa">Web</label>
                        <input name="web_empresa" type="text" class="form-control" id="web_empresa" value="<?php echo $info[0]->web; ?>">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <div class="form-group ">
                        <label for="dir_empresa">Dirección</label>
                        <input name="dir_empresa" type="text" class="form-control" id="dir_empresa" value="<?php echo $info[0]->direccion; ?>">
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="form-group">
                        <label for="logo_empresa">Subir Nuevo Logo</label>
                        <input name="logo_empresa" type="file" id="logo" value="<?php echo $info[0]->logo; ?>">
                        <p class="help-block">Puedes cambiar el logo de la empresa.</p>
                      </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                      <div class="checkbox">
                        <label>
                          <input name="confirmar" type="checkbox"> Estas seguro de realizar los cambios en la información de la empresa.
                        </label>
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
<!-- Modal Agregar Tipo Inmueble -->
<div class="modal fade" id="modal-add_tipo_inmueble">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Agregar Tipo de Inmueble</h4>
      </div>
      <form role="form" id="add_tipo_inmueble" action="<?php echo base_url().'admin/config_inmuebles/add_tipo_inmueble';?>" method="post">
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                    <div class="form-group ">
                      <label for="nom_tinmueble">Nombre del Tipo de Inmueble</label>
                      <input name="nom_tinmueble" type="text" class="form-control" id="nom_tinmueble" value="">
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                      <div class="form-group ">
                        <label for="descrip_tinmueble">Descripción Tipo de Inmueble</label>
                        <textarea name="descrip_tinmueble" type="text" class="form-control" id="descri_tinmueble" value="" rows="2"></textarea>
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
<!-- Modal Editar Tipo Inmueble -->
<div class="modal fade" id="modal-edit_tipo_inmueble">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Actualizar Tipo de Inmueble</h4>
      </div>
      <form role="form" id="edit_tipo_inmueble" action="#" method="post">
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                    <div class="form-group ">
                      <label for="edit_nom_tinmueble">Nombre del Tipo de Inmueble</label>
                      <input name="edit_nom_tinmueble" type="text" class="form-control" id="edit_nom_tinmueble" value="">
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                      <div class="form-group ">
                        <label for="edit_descrip_tinmueble">Descripción Tipo de Inmueble</label>
                        <textarea name="edit_descrip_tinmueble" type="text" class="form-control" id="edit_descrip_tinmueble" value="" rows="2"></textarea>
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
<!-- Modal Agregar Sector -->
<div class="modal fade" id="modal-add_sector">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Agregar Sector</h4>
      </div>
      <form role="form" id="add_sector" action="<?php echo base_url().'admin/config_inmuebles/add_sector';?>" method="post">
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                    <div class="form-group ">
                      <label for="nom_sector">Nombre del Sector</label>
                      <input name="nom_sector" type="text" class="form-control" id="nom_sector" value="">
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                      <div class="form-group ">
                        <label for="descrip_sector">Descripción del Sector</label>
                        <textarea name="descrip_sector" type="text" class="form-control" id="descrip_sector" value="" rows="2"></textarea>
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
<!-- Modal Editar Sector -->
<div class="modal fade" id="modal-edit_sector">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Actualizar Sector</h4>
      </div>
      <form role="form" id="edit_sector" action="#" method="post">
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                    <div class="form-group ">
                      <label for="edit_nom_sector">Nombre del Sector</label>
                      <input name="edit_nom_sector" type="text" class="form-control" id="edit_nom_sector" value="">
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                      <div class="form-group ">
                        <label for="edit_descrip_sector">Descripción del Sector</label>
                        <textarea name="edit_descrip_sector" type="text" class="form-control" id="edit_descrip_sector" value="" rows="2"></textarea>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>  Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Agregar Servicio -->
<div class="modal fade" id="modal-add_servicio">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Agregar Servicios</h4>
      </div>
      <form role="form" id="add_servicio" action="<?php echo base_url().'admin/config_inmuebles/add_servicio';?>" method="post">
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                    <div class="form-group ">
                      <label for="nom_servicio">Nombre del Servicio</label>
                      <input name="nom_servicio" type="text" class="form-control" id="nom_servicio" value="">
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                      <div class="form-group ">
                        <label for="descrip_servicio">Descripción del Servicio</label>
                        <textarea name="descrip_servicio" type="text" class="form-control" id="descrip_servicio" value="" rows="2"></textarea>
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
<!-- Modal Editar Servicio -->
<div class="modal fade" id="modal-edit_servicio">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Actualizar Servicio</h4>
      </div>
      <form role="form" id="edit_servicio" action="<?php echo base_url().'admin/config_inmuebles/add_servicio';?>" method="post">
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                    <div class="form-group ">
                      <label for="edit_nom_servicio">Nombre del Servicio</label>
                      <input name="edit_nom_servicio" type="text" class="form-control" id="edit_nom_servicio" value="">
                    </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
                      <div class="form-group ">
                        <label for="edit_descrip_servicio">Descripción del Servicio</label>
                        <textarea name="edit_descrip_servicio" type="text" class="form-control" id="edit_descrip_servicio" value="" rows="2"></textarea>
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


<script src="<?php echo base_url().'assets/adminjs/config_general.js';?>"></script>
