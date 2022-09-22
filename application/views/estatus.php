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
    <h1 class="h2">Estatus</h1>
  </div>
  <div>
    <button type="button" class="btn btn-labeled btn-primary"  id="btnAgregar" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="0">
    <span class="btn-label"><i class="bi bi-folder-plus"></i></span>&nbsp;&nbsp;Agregar</button>
  </div>
  <br>
  <!-- Registro -->
  <div class="modal fade" id="modalInventario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="inventarioModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inventarioModal"></h5>
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
  <div class="table-responsive">
    <table class="table" id="grid"></table>
    <div id="jqGridPager"></div>
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
$("#grid").jqGrid({
  url:'ajax/listadoEstatus',
  postData: {
    csrf_directorio_token : function(){ return ($('#token').val() != "") ? $('#token').val() : "";}
  },
  datatype: 'json',mtype: 'POST',height:' 350px', styleUI : 'Bootstrap5',iconSet:  'Bootstrap5',
  colNames:['Editar','Descripción'],
  colModel:[
  {name:'btnEditar',index:'btnEditar',width:'90px',resizable:false,sortable:false,align:'center',title:false},
  {name:'descripcion',index:'descripcion',width:'110px',resizable:false,sortable:true,align:'center',title:false},
  ],
  width: null,
  shrinkToFit: false,
  loadtext: 'Cargando...',
  pager: '#jqGridPager',
  rowNum:50,
  altRows:false,
  rowList:[50,100,500,1000],
  viewrecords: true,
  caption: 'Listado de estatus',
  multiselect: false
}).navGrid('#jqGridPager', { view: false, del: false, add: false, edit: false, refresh:true,search:false});
function cerrarModal(){
  $('#form')[0].reset();
}
function guardarEstatus() {
  const fd = new FormData(document.getElementById("form"));
  fd.append("csrf_directorio_token", $("#token").val());
  $.ajax({
    type: "POST",
    dataType: "json",
    cache: false,
    contentType: false,
    processData:false,
    url: "ajax/guardarEstatus",
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
    url: "ajax/cargarFormularioEstatus",
    data:{csrf_directorio_token:$('#token').val(),pk_estatus: id},
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
$(document).ready(function() {
  $(document).on("click",".btnEditar", function(){
    const id = $(this).data("id");
    $("#inventarioModal").html("Editar");
    cargarForm(id);
  });
  $("#btnAgregar").click( function(){
    const id = $(this).data("id");
    $("#inventarioModal").html("Agregar");
    cargarForm(id);
  });
  $('#enviar').click(function() {
    guardarEstatus();
  });
});
</script>