<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administración Judicial</title>

    <!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>" />

    <!-- MetisMenu CSS -->
	<link rel="stylesheet" href="<?php echo base_url("/assets/metisMenu/dist/metisMenu.min.css"); ?>" />
    
    <!-- Timeline CSS -->
	<link rel="stylesheet" href="<?php echo base_url("/dist/css/timeline.css"); ?>" />
    
    <!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo base_url("/dist/css/sb-admin-2.css"); ?>" />
  
    <!-- Morris Charts CSS -->
	<link rel="stylesheet" href="<?php echo base_url("/assets/morrisjs/morris.css"); ?>" />
    
    <!-- Custom Fonts -->
    <link rel="stylesheet" href="<?php echo base_url("/assets/font-awesome/css/font-awesome.min.css"); ?>" />

    <!-- Style personalizado -->
    <link rel="stylesheet" href="<?php echo base_url("/css/style.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("/css/datepicker.css"); ?>" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Administracion Judicial</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation" style="">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="<?=  base_url()?>index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?=  base_url()?>index.php/fichas/index"><i class="fa fa-search fa-fw"></i> Búsqueda por demanda</a>
                        </li>
                        <li>
                            <a href="<?=  base_url()?>index.php/Index/actualizar_estado"><i class="fa fa-pencil fa-fw"></i>Recepción de demandas</a>
                        </li>
                        <li>
                            <a href="<?=  base_url()?>index.php/Fichas/imprimir"><i class="fa fa-print fa-fw"></i>Imprimir códigos de barra</a>
                        </li>
                        <li>
                            <a href="<?=  base_url()?>index.php/Fichas/importar_fichas"><i class="fa fa-file fa-fw"></i>Cargar demandas</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        
            <!-- /.row -->
           
   
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script type="text/javascript" src='<?php echo base_url('js/jquery.min.js');?>'></script>

    <!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src='<?php echo base_url('/assets/bootstrap/js/bootstrap.js');?>'></script>
    
    <!-- Metis Menu Plugin JavaScript -->
	<script type="text/javascript" src='<?php echo base_url('/assets/metisMenu/dist/metisMenu.min.js');?>'></script>
    
    <!-- Morris Charts JavaScript -->
	<script type="text/javascript" src='<?php echo base_url('/assets/morrisjs/morris.min.js');?>'></script>
   
    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src='<?php echo base_url('/dist/js/sb-admin-2.js');?>'></script>
    <script type="text/javascript" src='<?php echo base_url('/assets/raphael/raphael-min.js');?>'></script>
   <script type="text/javascript" src='<?php echo base_url('/js/jqueryDatatable.js');?>'></script>
   <script type="text/javascript" src='<?php echo base_url('/js/bootstrap-datepicker.js');?>'></script>

