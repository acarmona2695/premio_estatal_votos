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
.chosen-container .chosen-results li.highlighted {
  background-color: #073c77;
  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #073c77), color-stop(90%, #073c77));
  background-image: -webkit-linear-gradient(#073c77 20%, #073c77 90%);
  background-image: -moz-linear-gradient(#073c77 20%, #073c77 90%);
  background-image: -o-linear-gradient(#073c77 20%, #073c77 90%);
  background-image: linear-gradient(#073c77 20%, #073c77 90%);
  color: #fff;
}
</style>
<main class="col-md-12 ms-sm-auto col-lg-12 px-md-12">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Votación</h1>
  </div>
  
  <div style="clear:both;"></div>
  <br>
  <div class="table-responsive">
    <table class="table" id="grid"></table>
    <div id="jqGridPager"></div>
  </div>
</main>
<?php include('common/footer.php');?>
<style>
.btnOragen {
  background-color: orange;
  color: #fff;
}
</style>
<script type="text/javascript">
$("#grid").jqGrid({
  url:'ajax/listadoVoto',
  postData: {
    csrf_directorio_token : function(){ return ($('#token').val() != "") ? $('#token').val() : "";}
  },
  datatype: 'json',mtype: 'POST',height:' 350px', styleUI : 'Bootstrap5',iconSet:  'Bootstrap5',
  colNames:['Editar','Modalidad','Nominado','Asociación','Voto','Usuario','Fecha<br> creación'],
  colModel:[
  {name:'btnEditar',index:'btnEditar',width:'90px',resizable:false,sortable:false,align:'center',title:false},
  {name:'fk_modalidad',index:'fk_modalidad',width:'110px',resizable:false,sortable:true,align:'center',title:false},
  {name:'fk_nominado',index:'fk_nominado',width:'110px',resizable:false,sortable:true,align:'center',title:false},
  {name:'fk_asociacion',index:'fk_asociacion',width:'110px',resizable:false,sortable:true,align:'center',title:false},
  {name:'punto',index:'punto',width:'110px',resizable:false,sortable:true,align:'center',title:false},
  {name:'fk_usuario',index:'fk_usuario',width:'110px',resizable:false,sortable:true,align:'center',title:false},
  {name:'fecha_creacion',index:'fecha_creacion',width:'110px',resizable:false,sortable:true,align:'center',title:false},
  ],
  width: null,
  shrinkToFit: false,
  loadtext: 'Cargando...',
  pager: '#jqGridPager',
  rowNum:50,
  altRows:false,
  rowList:[50,100,500,1000],
  viewrecords: true,
  caption: 'Listado de Votaciones',
  multiselect: false
}).navGrid('#jqGridPager', { view: false, del: false, add: false, edit: false, refresh:true,search:false});
function cerrarModal(){
  $('#form')[0].reset();
}

  $(document).on("click",".btnEditar", function(){
    const id = $(this).data("id");
    $("#inventarioModal").html("Editar");
    cargarForm(id);
  });

</script>