<form id="form">
  <input type="text" class="form-control" name="pk_asociacion" value="<?=$pk_asociacion?>" id="pk_asociacion" hidden>
  <div class="row">
    <div class="col-md-12">
      <label for="descripcion" class="col-form-label">Descripción:</label>
      <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?=$INFO['descripcion']?>" autocomplete="off" required>
    </div>
    <div class="col-md-6">
            <label class="form-label">Estatus</label>
            <select class="form-select chosen-select" aria-label="estatus" name="estatus" id="estatus">
            <option value="<=$INFO['estatus']?>"></option>
                <option value="Activo">Activo</option>
                <option value="Desactivado">Desactivado</option>
        </select>
        </div>
  </div>
</form>


