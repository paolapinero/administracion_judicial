<?php include_once APPPATH . 'views/templates/header.php';?>
<div class="container theme-showcase" id="page-wrapper" role="main">
	<br>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#agregaUsuario">Agregar Usuario</button>
<!-- Modal -->
<div class="modal fade" id="agregaUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Formulario para agregar usuario</h4>
      </div>
      
     <?php echo form_open('Usuarios/agregar') ?>
      <div class="modal-body">
        <div class="form-group">
		    <label for="nombre-usuario">Usuario (Ej: 12345678-9 o 19876543-K)</label>
		    <?php echo form_input('usuario','',array('id'=>'usuario','onkeypress' => 'return justNumbers(event)', 'maxlength'=>'10', 'placeholder' => 'RUT','class' => 'form-control', 'required'=>"true")); ?>
		</div>
		<div class="form-group">
		    <label for="nombre-usuario">Nombre</label>
		    <?php echo form_input('nombre','',array('id'=>'nombre','placeholder' => 'Nombre del Solicitante','class' => 'form-control', 'required'=>"true")); ?>
		</div>
		 <div class="form-group">
		    <label for="password-usuario">Contraseña</label>
		    <?php echo form_input('password','',array('id'=>'password','placeholder' => '***********','class' => 'form-control', 'required'=>"true")); ?>
		 </div>
		 <div class="form-group">
		    <label for="rango-usuario">Rango</label>
		    <?php 
				echo form_dropdown('rango_id', $rangos, '' ,array('class' => 'form-control','required' => 'true'));
			 ?> 
		</div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <input type="submit" class="btn btn-success" value="Crear Usuario">
      </div>
      
     <?php echo form_close() ?>
    </div>
  </div>
</div>

<br>
<br>
  	<table class="table table-hover">
  		<tbody><tr>
  			<th>ID</th>
  			<th>NOMBRE DE USUARIO</th>
  			<th>RANGO</th>
  			<th>Contraseña</th>
  			<th>OPCIONES</th>
  		</tr>
  		<?php 
  			echo form_open('Usuarios/editar'); 
  			foreach ($usuarios as $u) {
  				echo form_hidden('usuario_id', $u['id']);
  				?>
  				<tr>
  					<td><?php echo $u['id'] ?> </td>
  					<td><?php echo $u['rut'] ?> </td>
  					<td><?php 
  						echo form_dropdown('rango_id', $rangos, $u['rango_id'] ,array('class' => 'form-control'));
  					 ?> </td>
  					 <td>
  					 	<?php echo form_password('password','',array('placeholder' => '*******', 'class' => 'form-control')); ?>
  					 </td>
  					 <td>
	  					<a href="<?= base_url() ?>index.php/Usuarios/eliminar/<?php echo $u['id']?>"class="btn btn-danger btn-xs"><b>Eliminar</b></a>
	  					<button type="submit" class="btn btn-primary btn-xs"><b>Actualizar</b></button>
	  				</td>
  				</tr>
  				<?php
  				echo form_close();
  			}
  		?>
  	</tbody>
  </table>    
</div>
<script type="text/javascript">
	function justNumbers(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46) || (keynum == 45) || (keynum == 75))
        return true;
        return /\d/.test(String.fromCharCode(keynum));
    }
</script>
</body>
</html>