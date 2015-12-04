<?php include_once APPPATH . 'views/templates/header.php';?>
<div id='page-wrapper'>
  <div class="row">
    <div style="margin-top:25px">
        <h3>Favor escanee el código de barra de la demanda</h3>
<?php
  echo form_open('Index/actualizar_estado',array('id' => 'form_estado'));
  echo '<div class="col-sm-6">';
  echo form_input('key','',array('class' => 'form-control','autofocus' => true));
  echo '</div>';
  echo '<button type="button" onclick = "confirmarEstado()" class="btn btn-default" title="Haga click en el input antes de pistolear">';
  echo '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>';
  echo '</button>';
?>
  </div>
  </div>
</div>
 </div>
<script>
  $( "#form_estado" ).submit(function( event ) {
  alert( "Handler for .submit() called." );
  event.preventDefault();
});
function changeENTER(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13)) { 
    alert( "Handler for .submit() called." );
    event.preventDefault();
    return false; 
  } else {return true;} 
} 
document.onkeypress=changeENTER

</script>
</body>
</html>