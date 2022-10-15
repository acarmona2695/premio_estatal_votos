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
    <h1 class="h2">votos</h1>
  </div>
  
  <!--Acordion para filtrar resultado-->
  <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingOne" style="background-color: #073c77;">
        <button class="accordion-button collapsed buscador" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          Buscador
        </button>
      </h2>
      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
        <div class="card-body">
          <div class="row">         
            <div class="col-sm-6 col-md-6 col-lg-3">
              <label for="estatusf">Modalidad</label>
              <select class="form-select chosen-select" aria-label="modalidadf" name="modalidadf" id="modalidadf">
                <option value="">Seleccionar Modalidad...</option>
                <?php if(count($MODALIDAD) > 0){
                foreach($MODALIDAD as $k => $row){?>
                <option value="<?=$row['pk_modalidad']?>"><?=$row['descripcion']?></option>
                <?php }
                }?>
              </select>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
              <label>&nbsp;</label>
              <button type="button" class="btn btn-primary" id="btnBuscar" style="margin-top:21px;"><i class="bi bi-search"></i>Buscar</button>
              <button type="button" class="btn btn-primary" id="btnLimpiar" style="margin-top:21px;"><i class="bi bi-arrow-clockwise"></i>Limpiar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
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
  postData: {csrf_directorio_token : function(){ return ($('#token').val() != "") ? $('#token').val() : "";},
    modalidad : function(){ return ($.trim($('#modalidadf').val()) != "") ? $.trim($('#modalidadf').val()) : "";},
  },
  datatype: 'json',mtype: 'POST',height:'350px', styleUI : 'Bootstrap5',iconSet:  'Bootstrap5',
  colNames:['Nominado','Modalidad','Usuario','Fecha<br> creación','Puntos'],
  colModel:[

  {name:'nombre_usuario',index:'nombre_usuario',width:'220px',resizable:false,sortable:true,align:'left',title:false},
  {name:'nombre_nominado',index:'nombre_nominado',width:'220px',resizable:false,sortable:true,align:'left',title:false},
  {name:'modalidad',index:'modalidad',width:'135px',resizable:false,sortable:true,align:'left',title:false},
  {name:'fecha_creacion',index:'fecha_creacion',width:'95px',resizable:false,sortable:true,align:'left',title:false},
  {name:'punto',index:'punto',width:'120px',resizable:false,sortable:true,align:'left',title:false},
  
  ],
  loadComplete: function(data) {
    try {
      if(data.error){
        swal({
          title:"",
          text:data.msg,
          type:"error",
          confirmButtonColor: "#45BFEB",
          confirmButtonText: 'Aceptar'
        });
      }
    }catch(e) {
      swal({
        title:"",
        text:data.msg,
        type:"error",
        
      });
    }
  },
  width: null,
  shrinkToFit: false,
  loadtext: 'Cargando...',
  pager: '#jqGridPager',
  rowNum:50,
  altRows:false,
  rowList:[50,100,500,1000],
  viewrecords: true,
  caption: 'Listado de Resultado Votación',
  multiselect: false
}).navGrid('#jqGridPager', { view: false, del: false, add: false, edit: false, refresh:true,search:false});


$(document).ready(function(){
  $('.chosen-select').chosen({width:"200px", no_results_text: "No hay datos que coincidan con la búsqueda"});
  //////////////////////////////////////////
  $(".inputFilter").keydown(function (e) {
    if(e.keyCode == 13){
      $('#grid').trigger( 'reloadGrid' );
    }
  });

  $("#btnBuscar").click( function(){
    $('#grid').trigger( 'reloadGrid' );
  });

  $("#btnLimpiar").click( function(){
    $("#modalidadf").val('').trigger('chosen:updated');
    $('#grid').trigger( 'reloadGrid' );
  });

  
});
</script>