<?php include_once APPPATH . 'views/templates/header.php';?>
	<div class="container" id='page-wrapper'>
		
		<div class="row">
			<br>
			<div class="col-md-10">
				<?php echo form_open_multipart('Fichas/importar_fichas');?>
				<div class="row">
					<div class="col-md-6">
					<label>Seleccione un demandante</label>
					<?php echo form_dropdown('demandante_id', $demandantes, '' ,array('class' => 'form-control','required' => 'true')) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
					<label>Fecha de Asignación</label>
					<?php echo form_input('fecha_asignacion', '' ,array('class' => 'form-control datepicker','required' => 'true')) ?>
        		</div>
				</div>
				<div class="row" style="margin-top:10px">
					<div class="col-md-6">
					<label>Seleccione archivo para la carga</label>
					<input type="file" name="file" size="20" />
					<br/>
					</div>
				</div>
				<?= form_hidden ( 'process', TRUE );?>
				<input type="submit" value="Cargar" class="btn btn-primary"/>
			</div>
	</div>
<script>
	$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
});
</script>