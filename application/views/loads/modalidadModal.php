<form id="form">
  <input type="text" class="form-control" name="pk_modalidad" value="<?=$pk_modalidad?>" id="pk_modalidad" hidden>
  <div class="row">
    <div class="col-md-12">
      <label for="descripcion" class="col-form-label">Descripción:</label>
      <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?=$INFO['descripcion']?>" autocomplete="off" required>
    </div>
    <div class="col-md-12">
      <label for="estatus" class="col-form-label">Estatus:</label>
      <select class="form-select chosen-select" aria-label="estatus" name="estatus" required>
        <option value="">Seleccionar estatus...</option>
        <option value="0" <?=($INFO['estatus'] == '0') ? "selected":""?>>Inactivo</option>
        <option value="1" <?=($INFO['estatus'] == '1') ? "selected":""?>>Activo</option>
      </select>
    </div>
  </div>
</form>
<script type="text/javascript">
$(document).ready(function () {
  $('.chosen-select').chosen({width:"200px", no_results_text: "No hay datos que coincidan con la búsqueda"});
});
</script>