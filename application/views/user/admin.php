<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    if(!$this->session->userdata('login')) {
        redirect(base_url());
    }
?>
<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestión Residencial | Usuario</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/bower_components/bootstrap/dist/css/bootstrap.css';?>">
    <!-- <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
    rel="stylesheet" type="text/css" /> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/bower_components/font-awesome/css/font-awesome.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'/assets/bower_components/fullcalendar/dist/fullcalendar.min.css';?>">
    <link rel="stylesheet" href="<?php echo base_url().'/assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css';?>" media="print">
    <link rel="stylesheet" href="<?php echo base_url().'/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css';?>">
    <link href="<?php echo base_url().'/assets/bower_components/datatables.net-bs/css/buttons.bootstrap.min.css';?>" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/dist/css/AdminLTE.css';?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url().'/assets/dist/css/skins/skin-black.min.css';?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-black sidebar-mini fixed">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
              <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Gestion </b>Residencial</span>
            </a>

          <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
              <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url().'/assets/dist/img/logo.png';?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url().'/assets/dist/img/logo.png';?>" class="img-circle" alt="User Image">

                                    <p> Parque Jardin</p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url().'ingresar/logout';?>" class="btn btn-default btn-flat">Cerrar Sesion</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
          <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo base_url().'/assets/dist/img/logo.png';?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $this->session->userdata('nombres'); ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
                    </div>
                </div>

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENÚ DE NAVEGACIÓN</li>
                    <li class="menu-adm adm-inmuebles"><a href="#"><i class="fa fa-home"></i> <span>Gestión Inmueble</span></a></li>
                    <li>
                        <a href="<?php echo base_url().'loginuser/logout';?>">
                            <i class="fa fa-power-off"></i> <span>Cerrar Sesion</span>
                        </a>
                    </li>
                </ul>
            </section>
        <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <?php echo $contents; ?>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2019 <a href="#">Gestión Residencial</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="control-sidebar-home-tab">
                    <h3 class="control-sidebar-heading">Recent Activity</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                    <p>Will be 23 on April 24th</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-user bg-yellow"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                    <p>New phone +1(800)555-1234</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                    <p>nora@example.com</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                <div class="menu-info">
                                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                    <p>Execution time 5 seconds</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <h3 class="control-sidebar-heading">Tasks Progress</h3>
                    <ul class="control-sidebar-menu">
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Custom Template Design
                                    <span class="label label-danger pull-right">70%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Update Resume
                                    <span class="label label-success pull-right">95%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Laravel Integration
                                    <span class="label label-warning pull-right">50%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">
                                <h4 class="control-sidebar-subheading">
                                    Back End Framework
                                    <span class="label label-primary pull-right">68%</span>
                                </h4>

                                <div class="progress progress-xxs">
                                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane" id="control-sidebar-settings-tab">
                    <form method="post">
                        <h3 class="control-sidebar-heading">General Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Report panel usage
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Some information about this general settings option
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Allow mail redirect
                                <input type="checkbox" class="pull-right" checked>
                            </label>
                            <p>
                                Other sets of options are available
                            </p>
                        </div>
                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Expose author name in posts
                                <input type="checkbox" class="pull-right" checked>
                            </label>

                            <p>
                                Allow the user to show his name in blog posts
                            </p>
                        </div>

                        <h3 class="control-sidebar-heading">Chat Settings</h3>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Show me as online
                                <input type="checkbox" class="pull-right" checked>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Turn off notifications
                                <input type="checkbox" class="pull-right">
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="control-sidebar-subheading">
                                Delete chat history
                                <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </aside>
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- jQuery 3 -->
    <script src="<?php echo base_url().'/assets/bower_components/jquery/dist/jquery.min.js';?>"></script>
    <script src="<?php echo base_url().'/assets/bower_components/jquery-ui/jquery-ui.min.js';?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url().'/assets/bower_components/bootstrap/dist/js/bootstrap.min.js';?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'/assets/bower_components/fastclick/lib/fastclick.js';?>"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <script src="<?php echo base_url().'assets/bower_components/sweetalert/sweetalert.js';?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().'/assets/dist/js/adminlte.min.js';?>"></script>

    <?php if($this->uri->segment(2) == 'inmuebles') { ?>
        <script src="<?php echo base_url().'/assets/bower_components/datatables.net/js/jquery.dataTables.min.js';?>"></script>
        <script src="<?php echo base_url().'/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js';?>"></script>
    <?php } ?>
    <?php if($this->uri->segment(2) == 'eventos') { ?>
        <script src="<?php echo base_url().'assets/bower_components/moment/moment.js'; ?>"></script>
        <script src="<?php echo base_url().'assets/bower_components/fullcalendar/dist/fullcalendar.min.js'; ?>"></script>
    <?php } ?>


    <!-- SlimScroll -->
    <script src="<?php echo base_url().'/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js';?>"></script>
    <!-- ChartJS -->
    <?php if($this->uri->segment(1) == 'panel') { ?>
        <script src="<?php echo base_url().'/assets/bower_components/chart.js/Chart.js';?>"></script>
    <?php } ?>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().'/assets/dist/js/demo.js';?>"></script>
</body>
</html>

