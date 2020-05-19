<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        KARDEX
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li  class="active">KARDEX</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inm_id">Material:</label>
                                <select class="form-control" id="kd_material">
                                    <?php foreach ($materiales as $item): ?>
                                        <option value="<?php echo $item->id_material; ?>"><?php echo $item->nombre; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success" id="ver_kardex" style="margin-top: 23px">Consultar</button>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Documento</th>
                                <th>Cantidad</th>
                                <th>Saldo</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_kardexes">

                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<script src="<?php echo base_url().'assets/adminjs/kardex.js';?>"></script>




