<form id="form">
  <input type="text" class="form-control" name="pk_entrenador" value="<?=$pk_entrenador?>" id="pk_entrenador" hidden>
  <div class="row">
  <div class="col-md-12">
      <label for="nombre_entrenador" class="col-form-label">Nombre Completo del Entrenador:</label>
      <input type="text" class="form-control" name="nombre_entrenador" id="nombre_entrenador" value="<?=$INFO['nombre_entrenador']?>" autocomplete="off" required>
    </div>
  <div class="mb-3 col-md-4">
      <label for="fk_asociacion" class="col-form-label">Asociación:</label>
      <select class="form-select chosen-select" aria-label="fk_asociacion" name="fk_asociacion" id="fk_asociacion">
        <?php foreach($ASOCIACION as $k => $row){?>
          <option value="<?=$row['pk_asociacion']?>" <?=($INFO['fk_asociacion'] == $row['pk_asociacion']) ? "selected":""?>>
          <?=$row['nombre_asociacion']?></option>
        <?php }?>
      </select>
    </div>
    <div class="col-md-12">
    <label for="fk_disciplina" class="col-form-label">Disciplina:</label>
      <select class="form-select chosen-select" aria-label="fk_disciplina" name="fk_disciplina" id="fk_disciplina">
        <?php foreach($DISCIPLINA as $k => $row){?>
        <option value="<?=$row['pk_disciplina']?>" <?=($INFO['fk_disciplina'] == $row['pk_disciplina']) ? "selected":""?>>
        <?=$row['nombre_disciplina']?></option>
        <?php }?>
      </select>
    </div>
  </div>
</form>