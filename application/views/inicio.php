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

.container{
  padding: 50px;
  display: flex;
  justify-content: center;

}

.btn-d{
  color:black;
  font-size:24px;
  background-color:#6495ED;
  border:15px;
  margin-right: 20px; 
  width:250px;
  height:100px;

}

.btn-e{
  color:black;
  width:250px;
  height:100px;
  font-size:24px;
  background-color:#6495ED;
  border:15px;
 margin-right: 20px; 
}

.btn-f{
  color:black;
  width:250px;
  height:100px;
  font-size:24px;
  background-color:#6495ED;
  border:15px;
}


</style>
<main class="col-md-12 ms-sm-auto col-lg-12 px-md-12">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">VOTACIÓN PREMIO ESTATAL <?php echo date('Y');?> </h1>
  </div>

  <div class="container">
      <button type="button" class="btn btn-d"  id="btnDeportista" data-bs-toggle="modal" data-bs-target="#modalDeportista" data-id="0">
    <span class="btn-label"><i class=""></i></span>&nbsp;&nbsp;DEPORTISTA</button>


    <button type="button" class="btn btn-e"  id="btnEntrenador" data-bs-toggle="modal" data-bs-target="#modalEntrenador" data-id="0">
    <span class="btn-label"><i class=""></i></span>&nbsp;&nbsp;ENTRENADOR</button>

    <button type="button" class="btn btn-f"  id="btnFomento" data-bs-toggle="modal" data-bs-target="#modalFomento" data-id="0">
    <span class="btn-label"><i class=""></i></span>&nbsp;&nbsp;FOMENTO</button>
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
          <button type="button" class="btn btn-primary" onclick="enviar()">
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
          <button type="button" class="btn btn-primary"  onclick="enviarE()">
            <span class="btn-label"><i class="bi bi-save"></i></span>&nbsp;&nbsp;Guardar</button>
        </div>
      </div>
    </div>
  </div>

   <!-- Fomento -->
  <div class="modal fade" id="modalFomento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fomentoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fomentoModal"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="cerrarModal()"></button>
        </div>
        <div class="modal-body" id="HTMLMMM"></div>
        <div class="modal-footer">
          <button type="button" class="btn btnOragen"  data-bs-dismiss="modal" id="bntFormClose" onclick="cerrarModal()">
            <span class="btn-label"><i class="bi bi-box-arrow-left"></i></span>&nbsp;&nbsp;Cerrar</button>
          <button type="button" class="btn btn-primary"  onclick="enviarF()">
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


function enviar(){
  let nominado = $.trim($("#modalDeportista").find("#fk_nominado option:selected").text());
  if(nominado == ""){
    $.toast({
      heading: 'Error',
      text: "Debe seleccionar una un nominado",
      allowToastClose: true,
      position: 'mid-center',
      loader: true,
      icon: 'error'
    });
    return false;
  }
  const fd = new FormData(document.getElementById("form"));
  fd.append("csrf_directorio_token", $("#token").val());
  Swal.fire({
    title: '¿Está seguro?',
    html: "Asignara el voto en la categoria deportista a: <h4>"+nominado+"</h4> será guardado, y no podra revertir la selección, ¿desea continuar?.",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, realizar voto'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        dataType: "json",
        cache: false,
        contentType: false,
        processData:false,
        url: "ajax/guardarVotoDeportista",
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
          Swal.fire({
            title: 'Guardado!',
            html: 'El voto fue realizado con éxito',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          });
        },
        error: function(){
          $.unblockUI();
        }
      });
    }
  })
}

function enviarE(){
  let nominado = $.trim($("#modalEntrenador").find("#fk_nominado option:selected").text());
  if(nominado == ""){
    $.toast({
      heading: 'Error',
      text: "Debe seleccionar una un nominado",
      allowToastClose: true,
      position: 'mid-center',
      loader: true,
      icon: 'error'
    });
    return false;
  }
  const fd = new FormData(document.getElementById("form"));
  fd.append("csrf_directorio_token", $("#token").val());
  Swal.fire({
    title: '¿Está seguro?',
    html: "Asignara el voto en la categoria entrenador a: <h4>"+nominado+"</h4> será guardado, y no podra revertir la selección, ¿desea continuar?.",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, realizar voto'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        dataType: "json",
        cache: false,
        contentType: false,
        processData:false,
        url: "ajax/guardarVotoEntrenador",
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
          Swal.fire({
            title: 'Guardado!',
            html: 'El voto fue realizado con éxito',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          });
        },
        error: function(){
          $.unblockUI();
        }
      });
    }
  })
}

function enviarF(){
  let nominado = $.trim($("#modalFomento").find("#fk_nominado option:selected").text());
  if(nominado == ""){
    $.toast({
      heading: 'Error',
      text: "Debe seleccionar una un nominado",
      allowToastClose: true,
      position: 'mid-center',
      loader: true,
      icon: 'error'
    });
    return false;
  }
  const fd = new FormData(document.getElementById("form"));
  fd.append("csrf_directorio_token", $("#token").val());
  Swal.fire({
    title: '¿Está seguro?',
    html: "Asignara el voto en la categoria fomento a: <h4>"+nominado+"</h4> será guardado, y no podra revertir la selección, ¿desea continuar?.",
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, realizar voto'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        dataType: "json",
        cache: false,
        contentType: false,
        processData:false,
        url: "ajax/guardarVotoFomento",
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
          Swal.fire({
            title: 'Guardado!',
            html: 'El voto fue realizado con éxito',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          });
        },
        error: function(){
          $.unblockUI();
        }
      });
    }
  })
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


function cargarFormF(id){
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "ajax/cargarFormularioFomento",
    data:{csrf_directorio_token:$('#token').val(),pk_voto: id},
    beforeSend: function(){
      $("#HTMLMMM").html('<div class="text-center"><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>Cargando...</div>');
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
      $("#HTMLMMM").html(data.HTML);
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

  $("#btnFomento").click( function(){
    const id = $(this).data("id");
    $("#fomentoModal").html("Votar categoria fomento");
    cargarFormF(id);
  });


  $('#enviarD').click(function() {
    guardarVotoDeportista();
  });

  $('#enviarE').click(function() {
    guardarVotoEntrenador();
  });


  $('#enviarF').click(function() {
    guardarVotoFomento();
  });



});
</script>