<section class="content">
	<div class="row">
		<div class="col-md-8">
			<div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title">Registrar Empresa</h3>
				</div>
				<div class="box-body">
					<form class="form-horizontal" method="POST" action="<?php echo base_url().'admin/empresa/registro';?>">
					    <div class="form-group <?php echo form_error("ne_nit") != false ? 'has-error':''; ?>">
					        <label for="ne_nit" class="col-sm-2 control-label">NIT:</label>
					        <div class="col-sm-10">
					            <input type="text" class="form-control " name="ne_nit" id="ne_nit" placeholder="Ej: 808.852.963 - 85" value="<?php echo set_value('ne_nit'); ?>">
					            <?php echo form_error("ne_nit","<span class='help-block'>","</span>") ?>
					        </div>
					    </div>
					    <div class="form-group <?php echo form_error("ne_nombre") != false ? 'has-error':''; ?>">
					        <label for="ne_nombre" class="col-sm-2 control-label">Nombre:</label>
					        <div class="col-sm-10">
					            <input type="text" class="form-control" name="ne_nombre" id="ne_nombre" placeholder="Nombre" value="<?php echo set_value('ne_nombre'); ?>">
					            <?php echo form_error("ne_nombre","<span class='help-block'>","</span>") ?>
					        </div>
					    </div>
					    <div class="form-group <?php echo form_error("ne_direccion") != false ? 'has-error':''; ?>">
					        <label for="ne_direccion" class="col-sm-2 control-label">Dirección:</label>
					        <div class="col-sm-10">
					            <input type="text" class="form-control" name="ne_direccion" id="ne_direccion" placeholder="Dirección" value="<?php echo set_value('ne_direccion'); ?>">
					            <?php echo form_error("ne_direccion","<span class='help-block'>","</span>") ?>
					        </div>
					    </div>
					    <div class="form-group <?php echo form_error("ne_ciudad") != false ? 'has-error':''; ?>">
					        <label for="ne_ciudad" class="col-sm-2 control-label">Ciudad:</label>
					        <div class="col-sm-10">
					            <input type="text" class="form-control" name="ne_ciudad" id="ne_ciudad" placeholder="Ciudad" value="<?php echo set_value('ne_ciudad'); ?>">
					            <?php echo form_error("ne_ciudad","<span class='help-block'>","</span>") ?>
					        </div>
					    </div>
					    <div class="form-group <?php echo form_error("ne_telfijo") != false ? 'has-error':''; ?>">
					        <label for="ne_telfijo" class="col-sm-2 control-label">Tel Fijo:</label>
					        <div class="col-sm-10">
					            <input type="number" class="form-control" name="ne_telfijo" id="ne_telfijo" placeholder="Ej: 322 56 52 " value="<?php echo set_value('ne_telfijo'); ?>">
					            <?php echo form_error("ne_telfijo","<span class='help-block'>","</span>") ?>
					        </div>
					    </div>
					    <div class="form-group <?php echo form_error("ne_telcelular") != false ? 'has-error':''; ?>">
					        <label for="ne_telcelular" class="col-sm-2 control-label">Tel Celular:</label>
					        <div class="col-sm-10">
					            <input type="number" class="form-control" name="ne_telcelular" id="ne_telcelular" placeholder="Ej: 321 874 0021" value="<?php echo set_value('ne_telcelular'); ?>">
					            <?php echo form_error("ne_telcelular","<span class='help-block'>","</span>") ?>
					        </div>
					    </div>
					    <div class="form-group <?php echo form_error("ne_email") != false ? 'has-error':''; ?>">
					        <label for="ne_email" class="col-sm-2 control-label">Email:</label>
					        <div class="col-sm-10">
					            <input type="email" class="form-control" name="ne_email" id="ne_email" placeholder="Ej: email@gestion.net" value="<?php echo set_value('ne_email'); ?>">
					            <?php echo form_error("ne_email","<span class='help-block'>","</span>") ?>
					        </div>
					    </div>
				</div>
				<div class="box-footer">
	                <button type="submit" class="btn btn-info btn-flat pull-right"><i class="fa fa-save"></i> Registrar</button>
	                </form>
              	</div>
			</div>
		</div>
	</div>
</section>