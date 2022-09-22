<?php include('common/header.php');?>
<main class="col-md-12 ms-sm-auto col-lg-12 px-md-12">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cambiar contraseña</h1>
  </div>
  <div class="row">
    <form id="form">
      <input type="text" class="form-control" value="<?=$pk_usuario?>" name="pk_usuario" id="pk_usuario" hidden>
      <div class="col-md-2 mb-3">
        <label for="contrasena_usuario" class="col-form-label">Nueva contraseña:</label>
        <input type="text" class="form-control" minlength="8" name="contrasena_usuario" id="contrasena_usuario" required autocomplete="off">
      </div>
      <div class="col-md-2 mb-3">
        <button type="button" class="btn btn-labeled btn-primary" id="enviar">
          <span class="btn-label"><i class="bi bi-save"></i></span>&nbsp;&nbsp;Guardar</button>
      </div>
    </form>
  </div>
</main>
<?php include('common/footer.php');?>
<style type="text/css">
.btnOragen {
  background-color: orange;
  color: #fff;
}
</style>
<script type="text/javascript">
function guardarContrasena() {
  const fd = new FormData(document.getElementById("form"));
  fd.append("csrf_directorio_token", $("#token").val());
  $.ajax({
    type: "POST",
    dataType: "json",
    cache: false,
    contentType: false,
    processData:false,
    url: "ajax/guardarContrasena",
    data: fd,
    beforeSend: function(){
      $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff' }, message: '<h1>Espera un momento...</h1>', baseZ: 2000
      });
    },
    success: function(data){
      $.unblockUI();
      if(data.error){
        $.toast({
            heading: 'Error',
            text: data.msg,
            allowToastClose: true,
            position: 'mid-center',
            loader: true,
            icon: 'error'
        });
        return false;
      }
      $.toast({
          heading: 'Información',
          text: data.msg,
          position: 'mid-center',
          allowToastClose: true,
          icon: 'success',
          loader: true,
          loaderBg: '#9EC600'
      });
    },
    error: function(){
      $.unblockUI();
    }
  });
}
$(document).ready(function() {
    $('#enviar').click(function() {
    $nuevo = $("#contrasena_usuario").val();
    $.unblockUI();
    if($nuevo  == ''){
      $.toast({
          heading: 'Error',
          text: "El campo Nueva contraseña es obligatorio",
          allowToastClose: true,
          position: 'mid-center',
          loader: true,
          icon: 'error'
      });
      return false;
    }
    if($nuevo.length  < 8){
      $.toast({
        heading: 'Error',
        text: "La contraseña debe de tener minimo 8 caracteres",
        allowToastClose: true,
        position: 'mid-center',
        loader: true,
        icon: 'error'
      });
      return false;
    }else{
      guardarContrasena();
    }
   });
});
</script>
