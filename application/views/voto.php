<?php include('common/header.php');?>
<style type="text/css">
.ui-jqgrid .ui-jqgrid-htable .ui-th-div {
  height: 30px !important;
}
.ui-jqgrid .form-control {
  width: 100% !important;
}
.ui-jqgrid tr.jqgrow td {
  white-space: normal !important;
}
</style>
<main class="col-md-12 ms-sm-auto col-lg-12 px-md-12">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">CATEGORIAS PREMIO ESTATAL <?php echo date('Y');?></h1>
  </div>
  <div>
    <div class="container-fluid">
      <button type="button" class="btn btn-labeled btn-primary"  id="btnDeportista" data-bs-toggle="modal" data-bs-target="#modalDeportista" data-id="0">
    <span class="btn-label"><i class="bi bi-folder-plus"></i></span>&nbsp;&nbsp;DEPORTISTA</button>


    <button type="button" class="btn btn-labeled btn-primary"  id="btnEntrenador" data-bs-toggle="modal" data-bs-target="#modalEntrenador" data-id="0">
    <span class="btn-label"><i class="bi bi-folder-plus"></i></span>&nbsp;&nbsp;ENTRENADOR</button>
    </div>
    
  </div>
  <br>


  <!-- Deportista -->
  <div class="modal fade" id="modalDeportista" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deportistaModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deportistaModal"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="cerrarModal()"></button>
        </div>
        <div class="modal-body" id="HTMLM"></div>
        <div class="modal-footer">
          <button type="button" class="btn btnOragen"  data-bs-dismiss="modal" id="bntFormClose" onclick="cerrarModal()">
            <span class="btn-label"><i class="bi bi-box-arrow-left"></i></span>&nbsp;&nbsp;Cerrar</button>
          <button type="button" class="btn btn-primary"  id="enviar">
            <span class="btn-label"><i class="bi bi-save"></i></span>&nbsp;&nbsp;Guardar</button>
        </div>
      </div>
    </div>
  </div>


    <!-- Entrenador -->
  <div class="modal fade" id="modalEntrenador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="entrenadorModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="entrenadorModal"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="cerrarModal()"></button>
        </div>
        <div class="modal-body" id="HTMLMM"></div>
        <div class="modal-footer">
          <button type="button" class="btn btnOragen"  data-bs-dismiss="modal" id="bntFormClose" onclick="cerrarModal()">
            <span class="btn-label"><i class="bi bi-box-arrow-left"></i></span>&nbsp;&nbsp;Cerrar</button>
          <button type="button" class="btn btn-primary"  id="enviar">
            <span class="btn-label"><i class="bi bi-save"></i></span>&nbsp;&nbsp;Guardar</button>
        </div>
      </div>
    </div>
  </div>



 </main>
<?php include('common/footer.php');?>
<style type="text/css">
.btnOragen{
  background-color: orange;
  color: #fff;
}
</style>
<script type="text/javascript">
function cerrarModal(){
  $('#form')[0].reset();
}
function guardarVoto() {
  const fd = new FormData(document.getElementById("form"));
  fd.append("csrf_directorio_token", $("#token").val());
  $.ajax({
    type: "POST",
    dataType: "json",
    cache: false,
    contentType: false,
    processData:false,
    url: "ajax/guardarVoto",
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
      $('#grid').trigger( 'reloadGrid' );
      cerrarModal();
      $('#bntFormClose').click();
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
function cargarForm(id){
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "ajax/cargarFormularioDeportista",
    data:{csrf_directorio_token:$('#token').val(),pk_voto: id},
    beforeSend: function(){
      $("#HTMLM").html('<div class="text-center"><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>Cargando...</div>');
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
      $("#HTMLM").html(data.HTML);
    },
    error: function(){
      $.unblockUI();
    }
  });
}

function cargarFormE(id){
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "ajax/cargarFormularioEntrenador",
    data:{csrf_directorio_token:$('#token').val(),pk_voto: id},
    beforeSend: function(){
      $("#HTMLMM").html('<div class="text-center"><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>Cargando...</div>');
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
      $("#HTMLMM").html(data.HTML);
    },
    error: function(){
      $.unblockUI();
    }
  });
}
$(document).ready(function() {
  $("#btnDeportista").click( function(){
    const id = $(this).data("id");
    $("#deportistaModal").html("Votar categoria deportista");
    cargarForm(id);
  });

  $("#btnEntrenador").click( function(){
    const id = $(this).data("id");
    $("#entrenadorModal").html("Votar categoria entrenador");
    cargarFormE(id);
  });


  $('#enviar').click(function() {
    guardarVoto();
  });
});
</script>