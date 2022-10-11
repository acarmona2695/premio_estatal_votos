<form id="form">
  <input type="text" class="form-control" name="pk_nominado" value="<?=$pk_nominado?>" id="pk_nominado" hidden>
  <div class="row">
  <div class="col-md-12">
      <label for="nombre_nominado" class="col-form-label">Nombre:</label>
      <input type="text" class="form-control" name="nombre_nominado" id="nombre_nominado" value="<?=$INFO['nombre_nominado']?>" required autocomplete="off">
    </div>
    <div class="col-md-4">
      <label for="fk_asociacion" class="col-form-label">Asociación:</label>
      <select class="form-select chosen-select" aria-label="fk_asociacion" name="fk_asociacion" id="fk_asociacion">
        <option value="">Seleccionar asociación...</option>
        <?php foreach($ASOCIACION as $k => $row){?>
          <option value="<?=$row['pk_asociacion']?>" <?=($INFO['fk_asociacion'] == $row['pk_asociacion']) ? "selected":""?>>
          <?=$row['descripcion']?></option>
        <?php }?>
      </select>
    </div>
    <div class="col-md-4" id="fk_modalidad">
      <label for="fk_modalidad" class="col-form-label">Modalidad:</label>
      <select class="form-select chosen-select" aria-label="fk_modalidad" name="fk_modalidad" id="fk_modalidad">
        <option value="">Seleccionar modalidad...</option>
        <?php foreach($MODALIDAD as $k => $row){?>
        <option value="<?=$row['pk_modalidad']?>" <?=($INFO['fk_modalidad'] == $row['pk_modalidad']) ? "selected":""?>>
        <?=$row['descripcion']?></option>
        <?php }?>
      </select>
    </div>
    <div class="col-md-4">
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