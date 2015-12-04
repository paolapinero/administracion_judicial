<?php include_once APPPATH . 'views/templates/header.php';?>
<center>
    <div class="panel panel-primary col-md-8" style="float: none;margin-top: 60px;padding: 0px;">
        <div class="panel-heading"><b>PASO I: Escoja en orden los campos que contiene el excel </div></b>
        <div class="panel-body">
            <table style="width: 700px;">
                <tr>
                   <?php echo form_open_multipart('Fichas/importar_fichas');?>
                </tr>
                <tr>
                	<th>
                		Campos Posibles
                	</th>
                	<th>
                
                	</th>
                	<th>
                		Campos Seleccionados
                	</th>
                  </tr>
                  <tr>
                	<td width="45%">
                         <?php 
                        echo form_dropdown('disponibles',$campos_disponibles,'',array(
                            'label'=>false,
                            'id'=>'campos_disponibles',
                            'class' => 'form-control',
                            'size' => '6',
                            'style'=> 'height:200px',
                        )); ?>

              	     </td>
                	<td width="5%" align="center">
                    <button class="btn btn-primary" onclick="pasarSeleccion('seleccionados','campos_disponibles')"><span class="glyphicon glyphicon-chevron-left"></span></button>
                		<br />
                        <br />
                        <button class="btn btn-primary" onclick="pasarSeleccion('campos_disponibles','seleccionados')"><span class="glyphicon glyphicon-chevron-right"></span></button>	
               		</td>
                	<td width="45%">
                        <?php 
                        echo form_dropdown('seleccionados',null,'',array(
                            'label'=>false,
                            'id'=>'seleccionados',
                            'class' => 'form-control',
                            'size' => '6',
                            'style'=> 'height:200px',
                        )); ?>
                	</td>
                  </tr>
            </table>
    <br />
    <?php
    echo form_hidden('campos_procesar','',array(
        'value' => '',
        'id' => 'campos_procesar'
    ));
     ?>
    <input type="submit" class="btn btn-warning" name="Evento" value="Limpiar Todo" onclick="limpiar()"/>
    <div class="row">
        <div class="col-md-6">
        <label>Seleccione un demandante</label>
        <?php echo form_dropdown('demandante_id', $demandantes, '' ,array('class' => 'form-control','required' => 'true')) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <label>Fecha de asignación</label>
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
    </form>
    </div>
    </div>
</center>
<script>
    $( "#seleccionados" ).on( "dblclick", "option", function() {

        pasarSeleccion('seleccionados','campos_disponibles');
    });
    
    $( "#campos_disponibles" ).on( "dblclick", "option", function() {
       pasarSeleccion('campos_disponibles','seleccionados');
    });
    function pasarSeleccion(origen_id, destino_id){
        event.preventDefault();
        obj = document.getElementById(origen_id);
        if(obj.selectedIndex == -1){
            return;
        }
        valor = obj.value;
        txt = obj.options[obj.selectedIndex].text;
        if (origen_id == 'seleccionados') {
           obj.options[obj.selectedIndex] = null; 
        } else {
            obj2 = document.getElementById(destino_id);
            opc = new Option(txt, valor);
            eval(obj2.options[obj2.options.length] = opc);
        }
        return false;
    }
            
    function limpiar(){
        event.preventDefault();
        $.each($('#seleccionados option'), function( key, value ) {
            $(this).remove();
            //obj = $(this);;
//            valor = obj.value;
//            txt = obj.text;
//            console.debug(value);
//            console.debug(txt);
//           // obj.options[obj.selectedIndex] = null;
//            obj2 = document.getElementById('campos_disponibles');
//            opc = new Option(txt, valor);
//            eval(obj2.options[obj2.options.length] = opc);
        });
        
    }
    $('.datepicker').datepicker();
</script>