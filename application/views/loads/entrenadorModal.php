<form id="form">
  <input type="text" class="form-control" name="pk_voto" value="<?=$pk_voto?>" id="pk_voto" hidden>
  <div class="row">
    <div class="col-md-8">
      <label for="fk_nominado" class="col-form-label">Nominado:</label>
      <select class="form-select chosen-select" aria-label="fk_nominado" name="fk_nominado" id="fk_nominado">
        <option value="">Seleccionar nominado...</option>
        <?php foreach($ENTRENADOR as $k => $row){?>
          <option value="<?=$row['pk_nominado']?>" <?=($INFO['fk_nominado'] == $row['pk_nominado']) ? "selected":""?>>
          <?=$row['nombre_nominado']?></option>
        <?php }?>
      </select>
    </div>
    <div class="mb-3 col-md-4">
      <label for="punto" class="col-form-label">Voto:</label>
      <input type="text" class="form-control" name="punto" id="punto" value="1" required readonly>
    </div>
    <input type="text" class="form-control" name="fk_modalidad" value="2" id="fk_modalidad" hidden>
  </div>
</form>
<script type="text/javascript">
$(document).ready(function () {
  $('.chosen-select').chosen({width:"200px", no_results_text: "No hay datos que coincidan con la búsqueda"});
});
</script>