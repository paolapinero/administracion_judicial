<?php include_once APPPATH . 'views/templates/header.php';?>
<div id='page-wrapper'>
  <div class="row">
<?php
  echo form_open('Index/index');
  echo '<div class="col-sm-6">';
  echo form_input('key','',array('class' => 'form-control'));
  echo '</div>';
  echo form_submit('submit','Enviar',array('class' => 'btn btn-success'));
?>
  </div>
</div>
 </div>
</body>
</html>