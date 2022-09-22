<form id="form">
  <input type="text" class="form-control" name="pk_perfil" value="<?=$pk_perfil?>" id="pk_perfil" hidden>
  <div class="row">
    <div class="col-md-12">
      <label for="descripcion" class="col-form-label">Descripción:</label>
      <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?=$INFO['descripcion']?>" autocomplete="off" required>
    </div>
    <div class="col-md-12">
      <label for="comentarios" class="col-form-label">Comentarios:</label>
      <input type="text" class="form-control" name="comentarios" id="comentarios" value="<?=$INFO['comentarios']?>" autocomplete="off" required>
    </div>
  </div>
</form>