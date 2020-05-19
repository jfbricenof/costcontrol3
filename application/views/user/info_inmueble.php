<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Gestion Inmueble
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inmuebles</a></li>
        <li class="active">Inmueble <?php echo $inmueble[0]->id_inmueble; ?> </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div class="text-center"><i class="fa fa-home fa-4x"></i></div>
                    <h3 class="profile-username text-center"></i> Apartamento <?php echo $inmueble[0]->id_inmueble; ?></h3>
                    <p class="text-muted text-center">Conjunto Residencial</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <strong><i class="fa fa-book margin-r-5"></i> Tipo</strong>
                            <p class="text-muted">
                                <?php echo $inmueble[0]->nombre_tipo; ?>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Sector</strong>
                            <p class="text-muted"><?php echo $inmueble[0]->nombre_sector; ?></p>
                        </li>
                        <li class="list-group-item">
                            <strong><i class="fa fa-car margin-r-5"></i> Parqueadero</strong>
                            <p class="text-muted">
                                <?php foreach ($park as $par): ?>
                                <?php  echo $par->numero.' - '; ?>
                                <?php endforeach ?>
                            </p>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#md-edit-inmueble"><b>Editar</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#inm_pagos" data-toggle="tab"><i class="fa fa-dollar"></i> Facturas</a></li>
                    <li ><a href="#inm_propietario" data-toggle="tab"> <i class="fa fa-user"></i> Propietario</a></li>
                    <li ><a href="#inm_responsable" data-toggle="tab"> <i class="fa fa-user"></i> Responsable</a></li>
                    <!-- <li><a href="#inm_mensajes" data-toggle="tab"><i class="fa fa-envelope"></i> Mensajes</a></li> -->
                    <li><a href="#inm_residentes" data-toggle="tab"><i class="fa fa-users"></i> Residentes</a></li>
                    <li><a href="#inm_vehiculos" data-toggle="tab"><i class="fa fa-car"></i> Vehiculos</a></li>
                    <li><a href="#inm_mascotas" data-toggle="tab"><i class="fa fa-paw"></i> Mascotas</a></li>
                    <li><a href="#inm_notas" data-toggle="tab"><i class="fa fa-edit"></i> Notas</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="inm_pagos">
                        <!-- Tabla Sectores -->
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <!-- Sectores -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Mes</th>
                                                <th>Valor Total</th>
                                                <th>Saldo</th>
                                                <th>Estado</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-facturas">
                                            <?php foreach ($facturas as $fac): ?>
                                                <tr class="opc-fac<?php echo $fac->id_factura; ?>">
                                                    <td><?php echo $fac->fecha_inicio.' - '.$fac->fecha_fin; ?></td>
                                                    <td><?php echo number_format($fac->valor_total); ?></td>
                                                    <td><?php echo number_format($fac->saldo_factura); ?></td>
                                                    <td class="estado_fac estado_fac<?php echo $fac->id_factura; ?>">
                                                        <?php if ($fac->estado == "Pagada") { ?>
                                                                <span class="label label-success">
                                                                    <?php echo $fac->estado; ?>
                                                                </span>
                                                         <?php  } elseif ($fac->estado == "Pendiente") { ?>
                                                                <span class="label label-warning">
                                                                    <?php echo $fac->estado;?>
                                                                </span>
                                                        <?php  }else{ ?>
                                                                <span class="label label-danger">
                                                                    <?php echo $fac->estado;?>
                                                                </span>
                                                        <?php   }  ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                            <?php if ($fac->estado == "Pendiente") { ?>
                                                                <button class="btn btn-sm btn-warning factura_pagar btn-pago<?php echo $fac->id_factura; ?>" data-toggle="tooltip" data-url="<?php echo base_url(); ?>user/inmuebles/pagar_factura ?>" data-code="<?php echo $fac->id_factura; ?>" data-fecha="<?php echo $fac->fecha_vencimiento; ?>" data-original-title="Ver"><span class="fa fa-dollar"></span> Pagar</button>
                                                            <?php   }  ?>
                                                            <button class="btn btn-sm btn-default factura_ver" data-toggle="tooltip" data-url="<?php echo base_url(); ?>user/inmuebles/ver_factura/<?php echo $fac->id_factura; ?>" data-code="<?php echo $fac->id_factura; ?>" data-fecha="<?php echo $fac->fecha_vencimiento; ?>" data-original-title="Ver"><span class="fa fa-eye"></span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!-- /. Fin Tabla Sectores -->
                    </div>
                    <div class="tab-pane" id="inm_propietario">
                        <!-- tabla tipos inmuebles-->
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <!-- inmuebles-->
                            </div>
                            <!-- /.box-header -->
                            <form class="form-horizontal" method="POST" action="<?php echo base_url().'user/inmuebles/actualizar_persona';?>" id="actualizar_propietario">
                                <div class="box-body">
                                    <div class="form-group  has-feedback">
                                        <label for="inm_idpro" class="col-sm-3 control-label">ID Propietario</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="inm_idpro" class="form-control input-sm" value="<?php echo $propietario[0]->dni_persona; ?>">
                                            <i class="fa fa-user form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_nombre" class="col-sm-3 control-label">Nombres</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="inm_nombre" class="form-control input-sm" value="<?php echo $propietario[0]->nombres; ?>">
                                            <i class="fa fa-edit form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_apellidos" class="col-sm-3 control-label">Apellidos</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="inm_apellidos" class="form-control input-sm" value="<?php echo $propietario[0]->apellidos; ?>">
                                            <i class="fa fa-edit form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_email" class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="inm_email" class="form-control input-sm" value="<?php echo $propietario[0]->correo; ?>">
                                            <i class="fa fa-envelope form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_telefono" class="col-sm-3 control-label">Telefono</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="inm_telefono" class="form-control input-sm" value="<?php echo $propietario[0]->tel_fijo; ?>">
                                            <i class="fa fa-phone form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_celular" class="col-sm-3 control-label">Celular</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control input-sm" name="inm_celular" value="<?php echo $propietario[0]->tel_celular; ?>">
                                            <input type="hidden" name="id_persona" value="<?php echo $propietario[0]->id_persona; ?>">
                                            <i class="fa fa-mobile form-control-feedback"></i>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <button type="submit" class="btn btn-sm btn-success btn-flat pull-right"><i class="menu-icon fa fa-save"></i> Actualizar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.fin tabla tipos inmueble -->
                    </div>
                    <div class="tab-pane" id="inm_responsable">
                        <!-- tabla tipos inmuebles-->
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <!-- inmuebles-->
                            </div>
                            <!-- /.box-header -->
                            <form class="form-horizontal" method="POST" action="<?php echo base_url().'user/inmuebles/actualizar_responsable';?>" id="actualizar_responsable">
                                <div class="box-body">
                                    <div class="form-group  has-feedback">
                                        <label for="inm_idres" class="col-sm-3 control-label">ID Responsable</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="inm_idres" class="form-control input-sm" value="<?php echo $responsable[0]->dni_persona; ?>">
                                            <i class="fa fa-user form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_nombre_res" class="col-sm-3 control-label">Nombres</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="inm_nombre_res" class="form-control input-sm" value="<?php echo $responsable[0]->nombres; ?>">
                                            <i class="fa fa-edit form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_apellidos_res" class="col-sm-3 control-label">Apellidos</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="inm_apellidos_res" class="form-control input-sm" value="<?php echo $responsable[0]->apellidos; ?>">
                                            <i class="fa fa-edit form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_email_res" class="col-sm-3 control-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="inm_email_res" class="form-control input-sm" value="<?php echo $responsable[0]->correo; ?>">
                                            <i class="fa fa-envelope form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_telefono_res" class="col-sm-3 control-label">Telefono</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="inm_telefono_res" class="form-control input-sm" value="<?php echo $responsable[0]->tel_fijo; ?>">
                                            <i class="fa fa-phone form-control-feedback"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inm_celular_res" class="col-sm-3 control-label">Celular</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control input-sm" name="inm_celular_res" value="<?php echo $responsable[0]->tel_celular; ?>">
                                            <input type="hidden" name="id_persona" value="<?php echo $responsable[0]->id_persona; ?>">
                                            <i class="fa fa-mobile form-control-feedback"></i>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <button type="submit" class="btn btn-sm btn-success btn-flat pull-right"><i class="menu-icon fa fa-save"></i> Actualizar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.fin tabla tipos inmueble -->
                    </div>

                    <div class="tab-pane" id="inm_mensajes">
                        <!-- Tabla Servicios -->
                        <div class="box box-default ">
                            <div class="box-header with-border">
                                <!-- Servicios -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Asunto</th>
                                                <th>Mensaje</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($mensajes as $men): ?>
                                                <tr>
                                                    <td><?php echo $men->fecha_registro; ?></td>
                                                    <td><?php echo $men->asunto; ?></td>
                                                    <td><?php echo $men->mensaje; ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a class="btn btn-sm btn-info" data-toggle="tooltip" title="" href="#" data-original-title="Editar"><span class="fa fa-pencil"></span></a>
                                                            <button class="btn btn-sm btn-danger btn-eliminar" data-toggle="tooltip" title="" data-original-title="Eliminar"><span class="fa fa-trash"></span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success btn-flat pull-right">Agregar Servicios</a>
                            </div>
                        </div>
                        <!-- /. Fin Tabla Servicios -->
                    </div>
                    <div class="tab-pane" id="inm_residentes">
                        <!-- Tabla Servicios -->
                        <div class="box box-default ">
                            <div class="box-header with-border">
                                <!-- Servicios -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin table-condensed">
                                        <thead>
                                            <tr>
                                                <th>DNI</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Email</th>
                                                <th>Telefono</th>
                                                <th>Celular</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-residentes">
                                            <?php foreach ($residentes as $res): ?>
                                                <tr class="opc-res<?php echo $res->id_residente; ?>">
                                                    <td class="res-dni"><?php echo $res->dni_persona; ?></td>
                                                    <td class="res-nombres"><?php echo $res->nombres; ?></td>
                                                    <td class="res-apellidos"><?php echo $res->apellidos; ?></td>
                                                    <td class="res-correo"><?php echo $res->correo; ?></td>
                                                    <td class="res-telfijo"><?php echo $res->tel_fijo; ?></td>
                                                    <td class="res-telcelular"><?php echo $res->tel_celular; ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-default residente_editar" data-toggle="tooltip" data-url="<?php echo base_url(); ?>user/inmuebles/editar_residente/<?php echo $res->id_residente; ?>" data-code="<?php echo $res->id_persona; ?>" data-original-title="Editar"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default btn-eliminar residente_eliminar" data-url="<?php echo base_url().'user/inmuebles/eliminar_residente';?>" data-code="<?php echo $res->id_persona; ?>" data-res="<?php echo $res->id_residente; ?>" data-toggle="tooltip" title="" data-original-title="Eliminar"><span class="fa fa-trash"></span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#nuevo-residente" class="btn btn-sm btn-success btn-flat pull-right"><i class="fa fa-plus"></i> Agregar</a>
                            </div>
                        </div>
                        <!-- /. Fin Tabla Servicios -->
                    </div>
                    <div class="tab-pane" id="inm_vehiculos">
                        <!-- Tabla Servicios -->
                        <div class="box box-default ">
                            <div class="box-header with-border">
                                <!-- Servicios -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>Placa</th>
                                                <th>Marca</th>
                                                <th>Color</th>
                                                <th>Descripción</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-vehiculos">
                                            <?php foreach ($vehiculos as $veh): ?>
                                                <tr class="opc-veh<?php echo $veh->id_vehiculo; ?>">
                                                    <td class="veh-placa"><?php echo $veh->placa; ?></td>
                                                    <td class="veh-marca"><?php echo $veh->marca; ?></td>
                                                    <td class="veh-color"><?php echo $veh->color; ?></td>
                                                    <td class="veh-descripcion"><?php echo $veh->descripcion; ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-default vehilo_editar" data-toggle="tooltip" data-url="<?php echo base_url(); ?>user/inmuebles/editar_vehiculo/<?php echo $veh->id_vehiculo; ?>" data-original-title="Editar"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default btn-eliminar vehilo_eliminar" data-url="<?php echo base_url().'user/inmuebles/eliminar_vehiculo';?>" data-code="<?php echo $veh->id_vehiculo; ?>" data-toggle="tooltip" title="" data-original-title="Eliminar"><span class="fa fa-trash"></span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#md-nuevo-vehiculo" class="btn btn-sm btn-success btn-flat pull-right"><i class="fa fa-plus"></i> Agregar</a>
                            </div>
                        </div>
                        <!-- /. Fin Tabla Servicios -->
                    </div>
                    <div class="tab-pane" id="inm_mascotas">
                        <!-- Tabla Servicios -->
                        <div class="box box-default ">
                            <div class="box-header with-border">
                                <!-- Servicios -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Nombre</th>
                                                <th>Raza</th>
                                                <th>Descripción</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-mascotas">
                                            <?php foreach ($mascotas as $mas): ?>
                                                <tr class="opc-mas<?php echo $mas->id_mascota; ?>">
                                                    <td class="mas-tipo"><?php echo $mas->tipo; ?></td>
                                                    <td class="mas-nombre"><?php echo $mas->nombre; ?></td>
                                                    <td class="mas-raza"><?php echo $mas->raza; ?></td>
                                                    <td class="mas-descripcion"><?php echo $mas->descripcion; ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-default mascota_editar" data-toggle="tooltip" data-url="<?php echo base_url(); ?>user/inmuebles/editar_mascota/<?php echo $mas->id_mascota; ?>" data-original-title="Editar"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default btn-eliminar mascota_eliminar" data-url="<?php echo base_url().'user/inmuebles/eliminar_mascota';?>" data-code="<?php echo $mas->id_mascota; ?>" data-toggle="tooltip" title="" data-original-title="Eliminar"><span class="fa fa-trash"></span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#md-nueva-mascota" class="btn btn-sm btn-success btn-flat pull-right"> <i class="fa fa-plus"></i> Agregar</a>
                            </div>
                        </div>
                        <!-- /. Fin Tabla Servicios -->
                    </div>
                    <div class="tab-pane" id="inm_notas">
                        <!-- Tabla Servicios -->
                        <div class="box box-default ">
                            <div class="box-header with-border">
                                <!-- Servicios -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                                <th>Nota</th>
                                                <th>Fecha Registro</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="data-notas">
                                            <?php foreach ($notas as $not): ?>
                                                <tr class="opc-not<?php echo $not->id_notas_inmueble; ?>">
                                                    <td class="not-nota"><?php echo $not->nota; ?></td>
                                                    <td class="not-fecha"><?php echo $not->fecha_registro; ?></td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-default nota_editar" data-toggle="tooltip" data-url="<?php echo base_url(); ?>user/inmuebles/editar_nota/<?php echo $not->id_notas_inmueble; ?>" data-original-title="Editar"><span class="fa fa-pencil"></span></button>
                                                            <button class="btn btn-sm btn-default btn-eliminar nota_eliminar" data-url="<?php echo base_url().'user/inmuebles/eliminar_nota';?>" data-code="<?php echo $not->id_notas_inmueble; ?>" data-toggle="tooltip" title="" data-original-title="Eliminar"><span class="fa fa-trash"></span></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#md-nueva-nota" class="btn btn-sm btn-success btn-flat pull-right"><i class="fa fa-plus"> </i> Agregar </a>
                            </div>
                        </div>
                        <!-- /. Fin Tabla Servicios -->
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
<div class="modal fade" id="nuevo-residente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Nuevo Residente</h4>
            </div>
                <form class="form-horizontal" method="POST" action="<?php echo base_url().'user/inmuebles/agregar_residente';?>" id="nuevo_residente">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  has-feedback">
                                    <label for="res_idpro" class="col-sm-3 control-label">DNI Residente</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="res_idpro" class="form-control input-sm" placeholder="Identificación Residente">
                                        <i class="fa fa-user form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_nombre" class="col-sm-3 control-label">Nombres</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="res_nombre" class="form-control input-sm" placeholder="Nombres">
                                        <i class="fa fa-edit form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_apellidos" class="col-sm-3 control-label">Apellidos</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="res_apellidos" class="form-control input-sm" placeholder="Apellidos Residente">
                                        <i class="fa fa-edit form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_email" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="res_email" class="form-control input-sm" placeholder="Correo Electronico">
                                        <i class="fa fa-envelope form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_telefono" class="col-sm-3 control-label">Telefono</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="res_telefono" class="form-control input-sm" placeholder="Telefono Fijo">
                                        <i class="fa fa-phone form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_celular" class="col-sm-3 control-label">Celular</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control input-sm" name="res_celular" placeholder="Celular Residente">
                                        <input type="hidden" value="<?php echo $inmueble[0]->id_inmueble; ?>" name="id_inmueble">
                                        <i class="fa fa-mobile form-control-feedback"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-edit-residente">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Actualizar Residente</h4>
            </div>
                <form class="form-horizontal" method="POST" action="" id="editar_residente">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  has-feedback">
                                    <label for="res_idpro_edit" class="col-sm-3 control-label">DNI Residente</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="res_idpro_edit" class="form-control input-sm" placeholder="Identificación Residente">
                                        <i class="fa fa-user form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_nombre_edit" class="col-sm-3 control-label">Nombres</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="res_nombre_edit" class="form-control input-sm" placeholder="Nombres">
                                        <i class="fa fa-edit form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_apellidos_edit" class="col-sm-3 control-label">Apellidos</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="res_apellidos_edit" class="form-control input-sm" placeholder="Apellidos Residente">
                                        <i class="fa fa-edit form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_email_edit" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="res_email_edit" class="form-control input-sm" placeholder="Correo Electronico">
                                        <i class="fa fa-envelope form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_telefono_edit" class="col-sm-3 control-label">Telefono</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="res_telefono_edit" class="form-control input-sm" placeholder="Telefono Fijo">
                                        <i class="fa fa-phone form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="res_celular_edit" class="col-sm-3 control-label">Celular</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control input-sm" name="res_celular_edit" placeholder="Celular Residente">
                                        <i class="fa fa-mobile form-control-feedback"></i>
                                        <input type="hidden" name="id_persona_edit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-nuevo-vehiculo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Nuevo Vehiculo</h4>
            </div>
                <form class="form-horizontal" method="POST" action="<?php echo base_url().'user/inmuebles/agregar_vehiculo';?>" id="nuevo_vehiculo">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  has-feedback">
                                    <label for="veh_placa" class="col-sm-3 control-label">Placa</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="veh_placa" class="form-control input-sm"placeholder="Placa del Vehiculo">
                                        <i class="fa fa-automobile form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="veh_marca" class="col-sm-3 control-label">Marca</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="veh_marca" class="form-control input-sm"placeholder="Marca CHEVROLET,HONDA,KIA,TOYOTA" >
                                        <i class="fa fa-trophy form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="veh_color" class="col-sm-3 control-label">Color</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="veh_color" class="form-control input-sm"placeholder="Negro, Rojo, Azul..." >
                                        <i class="fa fa-tag form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="veh_desc" class="col-sm-3 control-label">Descripción</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="veh_desc" class="form-control input-sm" placeholder="Datos adicionales">
                                        <i class="fa fa-edit form-control-feedback"></i>
                                        <input type="hidden" value="<?php echo $inmueble[0]->id_inmueble; ?>" name="id_inmueble">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-edit-vehiculo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Editar Vehiculo</h4>
            </div>
                <form class="form-horizontal" method="POST" action="" id="editar_vehiculo">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  has-feedback">
                                    <label for="veh_placa_edit" class="col-sm-3 control-label">Placa</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="veh_placa_edit" class="form-control input-sm"placeholder="Placa del Vehiculo">
                                        <i class="fa fa-automobile form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="veh_marca_edit" class="col-sm-3 control-label">Marca</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="veh_marca_edit" class="form-control input-sm"placeholder="Marca CHEVROLET,HONDA,KIA,TOYOTA" >
                                        <i class="fa fa-trophy form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="veh_color_edit" class="col-sm-3 control-label">Color</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="veh_color_edit" class="form-control input-sm"placeholder="Negro, Rojo, Azul..." >
                                        <i class="fa fa-tag form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="veh_desc_edit" class="col-sm-3 control-label">Descripción</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="veh_desc_edit" class="form-control input-sm" placeholder="Datos adicionales">
                                        <i class="fa fa-edit form-control-feedback"></i>
                                        <input type="hidden" value="<?php echo $inmueble[0]->id_inmueble; ?>" name="id_inmueble">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-nueva-mascota">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Nueva Mascota</h4>
            </div>
                <form class="form-horizontal" method="POST" action="<?php echo base_url().'user/inmuebles/agregar_mascota';?>" id="nueva_mascota">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  has-feedback">
                                    <label for="mas_tipo" class="col-sm-3 control-label">Tipo</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="mas_tipo" class="form-control input-sm"placeholder="Perro, Gato, Loro, Hamster">
                                        <i class="fa fa-paw form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="mas_nombre" class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="mas_nombre" class="form-control input-sm"placeholder="Nombre de la mascota" >
                                        <i class="fa fa-edit form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="mas_raza" class="col-sm-3 control-label">Raza</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="mas_raza" class="form-control input-sm"placeholder="Negro, Rojo, Azul..." >
                                        <i class="fa fa-tag form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="mas_desc" class="col-sm-3 control-label">Descripción</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="mas_desc" class="form-control input-sm" placeholder="Datos adicionales">
                                        <i class="fa fa-edit form-control-feedback"></i>
                                        <input type="hidden" value="<?php echo $inmueble[0]->id_inmueble; ?>" name="id_inmueble">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-edit-mascota">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Actualizar Mascota</h4>
            </div>
                <form class="form-horizontal" method="POST" action="" id="editar_mascota">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  has-feedback">
                                    <label for="mas_tipo_edit" class="col-sm-3 control-label">Tipo</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="mas_tipo_edit" class="form-control input-sm"placeholder="Perro, Gato, Loro, Hamster">
                                        <i class="fa fa-paw form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="mas_nombre_edit" class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="mas_nombre_edit" class="form-control input-sm"placeholder="Nombre de la mascota" >
                                        <i class="fa fa-edit form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="mas_raza_edit" class="col-sm-3 control-label">Raza</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="mas_raza_edit" class="form-control input-sm"placeholder="Negro, Rojo, Azul..." >
                                        <i class="fa fa-tag form-control-feedback"></i>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="mas_desc_edit" class="col-sm-3 control-label">Descripción</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="mas_desc_edit" class="form-control input-sm" placeholder="Datos adicionales">
                                        <i class="fa fa-edit form-control-feedback"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-factura">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Factura</h4>
            </div>
                <div class="modal-body">
                    <section class="invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    Factura Junio.
                                    <small class="pull-right" id="estado-factura"></small>
                                </h2>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                De
                                <address>
                                    <strong>Administración.</strong><br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Para
                                <address>
                                    <strong id="fac-nombreprop"></strong><br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b id="fac-id"></b><br>
                                <b>Fecha Vencimiento:</b> <span id="fac-fec-venc"></span><br>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Concepto</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle-factura">

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                                <p class="lead">Metodos de pago:</p>
                                <img src="<?php echo base_url().'/assets/dist/img/credit/visa.png'; ?>" alt="Visa">
                                <img src="<?php echo base_url().'/assets/dist/img/credit/mastercard.png'; ?>" alt="Mastercard">
                                <img src="<?php echo base_url().'/assets/dist/img/credit/american-express.png'; ?>" alt="American Express">
                                <img src="<?php echo base_url().'/assets/dist/img/credit/paypal2.png'; ?>" alt="Paypal">

                                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                    Consigne en cuenta de ahorros Colpatria # xxxxxxxxxxx <br>
                                    Esta factura se asemeja a una letra de cambio y normatividad conforme a la ley
                                    131 de 2008 <br>
                                    Si ya realizo el pago haga caso Omiso.
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-6">
                                <p class="lead">Monto adeudado 06/22/2018</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td id="fac-subtotal"></td>
                                        </tr>
                                        <tr>
                                            <th>IVA</th>
                                            <td>$0</td>
                                        </tr>
                                        <tr>
                                            <th>Pago Anticipado:</th>
                                            <td>$0</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td id="fac-total"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</a>

                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-nueva-nota">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Agregar Nota</h4>
            </div>
                <form  method="POST" action="<?php echo base_url().'user/inmuebles/agregar_nota';?>" id="nueva_nota">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  has-feedback">
                                    <label for="not_nota">Nota</label>
                                    <textarea  name="not_nota" class="form-control input-sm" placeholder="Escribe la nota..."></textarea>
                                    <i class="fa fa-edit form-control-feedback"></i>
                                    <input type="hidden" value="<?php echo $inmueble[0]->id_inmueble; ?>" name="id_inmueble">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-edit-nota">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Agregar Nota</h4>
            </div>
                <form  method="POST" action="" id="editar_nota">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  has-feedback">
                                    <label for="not_nota_edit">Nota</label>
                                    <textarea  name="not_nota_edit" class="form-control input-sm"placeholder="Escribe la nota..."></textarea>
                                    <i class="fa fa-edit form-control-feedback"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-edit-inmueble">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Parqueaderos</h4>
            </div>
            <div class="modal-body">
                <form  method="POST" action="<?php echo base_url().'user/inmuebles/agregar_park';?>" id="nuevo_park">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group  has-feedback">
                                <label for="park_numero">Número</label>
                                <input  name="park_numero" class="form-control input-sm"placeholder="Escribe el numero del Parqueadero..."></input>
                                <i class="fa fa-edit form-control-feedback"></i>
                                <input type="hidden" value="<?php echo $inmueble[0]->id_inmueble; ?>" name="id_inmueble">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-sm" style="margin-top: 25px;">Guardar</button>
                        </div>
                    </div>
                </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                            <th>Número</th>
                                            <th>Fecha Registro</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-park">
                                        <?php foreach ($park as $par): ?>
                                            <tr class="opc-par<?php echo $par->id_parqueadero; ?>">
                                                <td class="par-numero"><?php echo $par->numero; ?></td>
                                                <td class="par-fecha"><?php echo $par->fecha_registro; ?></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-default btn-eliminar park_eliminar" data-url="<?php echo base_url().'user/inmuebles/eliminar_park';?>" data-code="<?php echo $par->id_parqueadero; ?>" data-toggle="tooltip" title="" data-original-title="Eliminar"><span class="fa fa-trash"></span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="md-nuevo-pago">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Realizar Pago</h4>
            </div>
            <form class="" id="nuevo_pago" method="POST" action="<?php echo base_url().'user/inmuebles/pagar_factura';?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 >Información Pago</h4>
                            <div class="form-group has-feedback">
                                <label for="pa_recibo"># Recibo</label>
                                <input type="number" class="form-control input-sm" name="pa_recibo" placeholder="Recibo de Pago">
                                <i class="fa fa-home form-control-feedback"></i>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="pa_tipo">Tipo Pago</label>
                                <select name="pa_tipo" class="form-control input-sm">
                                    <?php foreach ($tipos_pago as $tipo): ?>
                                    <option value="<?php echo $tipo->id_tipo_pago; ?>"><?php echo $tipo->nombre; ?></option>
                                    <?php endforeach ?>
                                </select>
                                <i class="fa fa-cube form-control-feedback"></i>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="pa_valor">Valor Pago</label>
                                <input type="number" class="form-control input-sm" name="pa_valor" placeholder="Ingrese el valor del pago">
                                <i class="fa fa-home form-control-feedback"></i>
                                <input type="hidden" name="pa_id_factura">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo base_url().'/assets/adminjs/info_inmueble.js';?>"></script>