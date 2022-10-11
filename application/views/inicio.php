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

.contenedor{
  padding: 50px;
  display: flex;
  justify-content: center;

}

.btn-1{
  font-size:24px;
  background-color:#6495ED;
  border:15px;
  margin-right: 20px; 
  width:250px;
  height:100px;

}

.btn-2{
  width:250px;
  height:100px;
  font-size:24px;
  background-color:#6495ED;
  border:15px;
 margin-right: 20px; 
}

.btn-3{
  width:250px;
  height:100px;
  font-size:24px;
  background-color:#6495ED;
  border:15px;

}

</style>
<main class="col-md-12 ms-sm-auto col-lg-12 px-md-12">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Votación premio estatal <?php echo date('Y');?> </h1>
  </div>

  <div class="contenedor">
    
  <button type="button" class="btn-1" id="btnAtleta" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="0">
        <span class="btn-label"><i class=""></i></span>&nbsp;&nbsp;Deportista</button>
    
      <button type="button" class="btn-2" id="btnEntrenador" data-bs-toggle="modal" data-bs-target="#modalInventario2" data-id="1">
        <span class="btn-label"><i class=""></i></span>&nbsp;&nbsp;Entrenador</button>
    
      <button type="button" class="btn-3" id="btnFomento" data-bs-toggle="modal" data-bs-target="#modalInventario3" data-id="2">
        <span class="btn-label"><i class=""></i></span>&nbsp;&nbsp;Fomento</button>
  </div>


<!-- 
  <!-- Modal Deportista -->
  <div class="modal fade" id="modalInventario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inventarioModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inventarioModal"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="cerrarModal()"></button>
        </div>
        <div class="modal-body" id="HTMLM"></div>
        <div class="modal-footer">
          <button type="button" class="btn btnOrange" data-bs-dismiss="modal" id="bntFormClose" onclick="cerrarModal()">
            <span class="btn-label"><i class="bi bi-box-arrow-left"></i></span>&nbsp;&nbsp;Cerrar</button>
          <!-- <button type="button" class="btn btn-primary"  id="enviar">
            <span class="btn-label"><i class="bi bi-save"></i></span>&nbsp;&nbsp;Guardar</button> -->
        </div>
      </div>
    </div>
  </div>

 
  <!-- Modal Entrenador -->
  <div class="modal fade" id="modalInventario2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inventarioModal2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inventarioModal2"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="cerrarModal2()"></button>
        </div>
        <div class="modal-body" id="HTMLM"></div>
        <div class="modal-footer">
          <button type="button" class="btn btnOrange" data-bs-dismiss="modal" id="bntFormClose" onclick="cerrarModal2()">
            <span class="btn-label"><i class="bi bi-box-arrow-left"></i></span>&nbsp;&nbsp;Cerrar</button>
          <button type="button" class="btn btn-primary"  id="enviar">
            <span class="btn-label"><i class="bi bi-save"></i></span>&nbsp;&nbsp;Guardar</button>
        </div>
      </div>
    </div>
  </div>

  
  <!-- Modal Fomento -->
  <div class="modal fade" id="modalInventario3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inventarioModal3" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inventarioModal3"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="cerrarModal3()"></button>
        </div>
        <div class="modal-body" id="HTMLM"></div>
        <div class="modal-footer">
          <button type="button" class="btn btnOrange" data-bs-dismiss="modal" id="bntFormClose" onclick="cerrarModal3()">
            <span class="btn-label"><i class="bi bi-box-arrow-left"></i></span>&nbsp;&nbsp;Cerrar</button>
          <button type="button" class="btn btn-primary"  id="enviar">
            <span class="btn-label"><i class="bi bi-save"></i></span>&nbsp;&nbsp;Guardar</button>
        </div>
      </div>
    </div>
  </div>
  

</main>
<?php include('common/footer.php');?>
<style>
.btnOrange {
  background-color:#ffA500;
  color: #000000;
}
</style>
<script type="text/javascript">


//Obtener datos de nominados por modalidad
function cargarForm(id){
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "ajax/cargarFormularioInicio",
    data:{csrf_directorio_token:$('#token').val(), pk_voto: id},
    beforeSend: function(){
      $("#HTMLM").html('<div class="text-center"><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>Cargando...</div>');
      $.blockUI({ css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff' }, message: '<h1>Espera un momento...</h1>', baseZ: 2000 });
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


//...............................Obtener datos de nominados por modalidad..............................................//
// function listNominadosForModalidadForUser(idModalidad, idUsuario){
//   $.ajax({
//     type: "POST",
//     dataType: "json",
//     url: "ajax/listNominadosForModalidadForUser",
//     data:{csrf_directorio_token:$('#token').val(), modalidad: idModalidad, usuario: idUsuario},
//     beforeSend: function(){
//       $("#HTMLM").html('<div class="text-center"><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Cargando...</span></div>Cargando...</div>');
//       $.blockUI({ css: {
//         border: 'none',
//         padding: '20px',
//         backgroundColor: '#000',
//         '-webkit-border-radius': '10px',
//         '-moz-border-radius': '10px',
//         opacity: .5,
//         color: '#fff' }, message: '<h1>Espera un momento...</h1>', baseZ: 2000 });
//     },
//     success: function(data){


//       console.log("Nominados", data);
      
//       const nominadosOption= [];


//       for (const nominado of data.nominados) {
//         nominadosOption.push({
//           idNominado: nominado.pk_nominado,
//           nombre: nominado.nombre_nominado,
//           disabled: true
//         });
//         console.log(nominado.nombre_nominado);
//       }

     

//     },
//     error: function(){
//       $.unblockUI();
//     }
//   });
// }
//---------------------------------------------------------------------------------------------------------------------//

function cerrarModal(){
  $('#form')[0].reset();
}

$("#btnAtleta").click( function(){
    const id = $(this).data("id");
    $("#inventarioModal").html("PREMIO ESTATAL DEL DEPORTE 2022 DEPORTISTA");
    cargarForm(id);


  });


//...................................................Abrir modal de votación atleta........................................//
// $("#btnAtleta").click( function(){
  
//   const idModalidad = 1;
//   const idUsuario = "?php echo $this->session->userdata('pb_idUsuario'); ?>";
//   $("#inventarioModal").html("PREMIO ESTATAL DEL DEPORTE 2022  ATLETA O DEPORTISTA");
//   listNominadosForModalidadForUser(idModalidad, idUsuario);

// });

  //.......................................................................................................................

  function cerrarModal2(){
  $('#form')[1].reset();
}
  
  $("#btnEntrenador").click( function(){
    const id = $(this).data("id");
    $("#inventarioModal2").html("PREMIO ESTATAL DEL DEPORTE 2022 ENTRENADOR");
    cargarForm(id);


  });

 
  function cerrarModal3(){
  $('#form')[2].reset();
}

  $("#btnFomento").click( function(){
    const id = $(this).data("id");
    $("#inventarioModal3").html("PREMIO ESTATLA DEL DEPORTE 2022  FOMENTO, PROTECCION O EL IMPULSO A LA PRACTICA DE LOS DEPORTES");
    cargarForm(id);

  });


</script>

