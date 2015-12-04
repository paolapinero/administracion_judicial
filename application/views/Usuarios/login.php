<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de Tramitacion Judicial</title>
    <link rel="stylesheet" href="<?php echo base_url("/assets/bootstrap/css/bootstrap.min.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("/assets/bootstrap/css/signin.css"); ?>" />
  </head>

  <body>
    <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <div class="container">
    <div class="row">
        <?php if (validation_errors()) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors() ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        <?php endif; ?>

   <div class="form-signin" >
        <img alt="Logo Serbanc" src=<?php echo base_url("/img/logo.png") ?>
        
        <br />
        <br />
        <br />
        <br />

    <?= form_open() ?>
        <label for="usuario" class="sr-only">Nombre de Usuario : </label>
            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Nombre de Usuario" required autofocus />
            
        <label for="pass" class="sr-only">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required />
       
        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesión</button>
        <br />
    </form>

    </div> <!-- /container -->
    </div> <!-- /container -->
    
    <!--<script src="webroot/js/jquery.js"></script>-->
    <!--<script src="webroot/js/bootstrap.min.js"></script>-->
   <!-- <script src="webroot/js/bootstrap.js"></script>-->
  </body>
</html>