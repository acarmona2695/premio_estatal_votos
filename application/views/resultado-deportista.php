<?php include('common/header2.php');?>
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
    <h1 class="h2">Resultados categoria deportista</h1>
  </div>
  <div style="clear:both;"></div>
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
  url:'ajax/listadoRdeportista',
  postData: {csrf_directorio_token : function(){ return ($('#token').val() != "") ? $('#token').val() : "";},
    modalidad : function(){ return ($.trim($('#modalidadf').val()) != "") ? $.trim($('#modalidadf').val()) : "";},
  },
  datatype: 'json',mtype: 'POST',height:'350px', styleUI : 'Bootstrap5',iconSet:  'Bootstrap5',
  colNames:['Nominado','Modalidad','Puntos','Total','Usuario'],
  colModel:[

  {name:'nominado',index:'nominado',width:'220px',resizable:false,sortable:true,align:'left',title:false},
  {name:'modalidad',index:'modalidad',width:'220px',resizable:false,sortable:true,align:'left',title:false},
  {name:'punto',index:'punto',width:'80px',resizable:false,sortable:true,align:'center',title:false},
  {name:'total',index:'total',width:'95px',resizable:false,sortable:true,align:'left',title:false},
  {name:'usuario',index:'usuario',width:'120px',resizable:false,sortable:true,align:'left',title:false},
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
  var duration = 15 * 3000;
var animationEnd = Date.now() + duration;
var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

function randomInRange(min, max) {
  return Math.random() * (max - min) + min;
}

var interval = setInterval(function() {
  var timeLeft = animationEnd - Date.now();

  if (timeLeft <= 0) {
    return clearInterval(interval);
  }

  var particleCount = 50 * (timeLeft / duration);
  // since particles fall down, start a bit higher than random
  confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
  confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
}, 250);

var end = Date.now() + (15 * 3000);

// go Buckeyes!
var colors = ['#bb0000', '#ffffff'];

(function frame() {
  confetti({
    particleCount: 2,
    angle: 60,
    spread: 55,
    origin: { x: 0 },
    colors: colors
  });
  confetti({
    particleCount: 2,
    angle: 120,
    spread: 55,
    origin: { x: 1 },
    colors: colors
  });

  if (Date.now() < end) {
    requestAnimationFrame(frame);
  }
}());



  
});
</script>