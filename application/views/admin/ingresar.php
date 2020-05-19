<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CostControl | Ingresar</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/bower_components/bootstrap/dist/css/bootstrap.min.css';?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/bower_components/font-awesome/css/font-awesome.min.css';?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/dist/css/AdminLTE.css';?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <img class="login-img img-responsive img-circle" src="<?php echo base_url().'/assets/dist/img/logo.png';?>" alt="">
        <div class="login-logo">
            <a href=""><b>Cost </b>Control</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <h4>Inicia sesión para comenzar</h4>
            <?php if ($this->session->flashdata("error")): ?>
            <div class="alert alert-danger">
                <p><?php echo $this->session->flashdata("error"); ?></p>
            </div>
            <?php endif ?>
            <form method="POST" action="<?php echo base_url().'ingresar/validar';?>">
                <div class="form-group <?php echo form_error("email") != false ? 'has-error':''; ?>">
                    <input type="email" class="form-control " name="email" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <?php echo form_error("email","<div class='text-danger'>","</div>") ?>
                </div>
                <div class="form-group <?php echo form_error("email") != false ? 'has-error':''; ?>">
                    <input type="password" class="form-control " name="password" placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <?php echo form_error("password","<div class='text-danger'>","</div>") ?>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="form-group">
                            <label>
                                <input type="checkbox"> Recordar Contraseña
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Ingresar</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- <a href="#">Olvidé mi contraseña</a><br>
            <a href="register.html" class="text-center">Registrarme</a> -->

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?php echo base_url().'/assets/bower_components/jquery/dist/jquery.min.js';?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url().'/assets/bower_components/bootstrap/dist/js/bootstrap.min.js';?>"></script>
</body>
</html>
