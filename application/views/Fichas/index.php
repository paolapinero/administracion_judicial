<?php include_once APPPATH . 'views/templates/header.php';?>
<div class="container" id='page-wrapper'>
	<table class="table table-hover" id="tabla_fichas">
		<thead>
			<tr class="success">
				<th># de Ficha </th>
				<th>RUT</th>
				<th>Demandado</th>
				<th>Estado</th>
				<th>SubEstado</th>
				<th style="width:70px">Opciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($fichas as $ficha) {

				?>
				<tr>
					<td><?= $ficha['id'] ?></td>
					<td><?= $ficha['rut'] ?></td>
					<td><?= $ficha['nombre'] ?></td>
					<td><?= $ficha['estado'] ?></td>
					<td><?= $ficha['subestado'] ?></td>
					<td>
						<a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#verFicha"><span class="glyphicon glyphicon-search"></span></a>
						<a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#verAgenda"><span class="glyphicon glyphicon-list"></span></a>
						<a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#agregarDiligencia"><span class="glyphicon glyphicon-plus"></span></a>
					</td>
				</tr>	
				<?php	
			}
			?>
		</tbody>
	</table>
</div>
<!-- Modal agenda -->
<div class="modal fade" id="verFicha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ver Ficha</h4>
      </div>
      <div class="modal-body">
      		<?php
      		echo form_open('Fichas/editar_ficha');
      		echo form_hidden('id','',array('id'));
      		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal ver ficha completa -->
<div class="modal fade" id="verAgenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Agregar diligencia -->
<div class="modal fade" id="agregarDiligencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>	
<script>
$(document).ready(function(){
    $('#tabla_fichas').DataTable({
       "language": {
                "url": '<?php echo base_url("/js/bootstrap-dataTables-Spanish.json") ?>',
                "decimal": ",",
                "thousands": "."
            },
    });
});
</script>