<form id="form">
  <input type="text" class="form-control" name="pk_usuario" value="<?=$pk_usuario?>" id="pk_usuario" hidden>
  <div class="row">
    <div class="mb-3 col-md-4">
      <label for="fk_perfil" class="col-form-label">Perfil:</label>
      <select class="form-select chosen-select" aria-label="fk_perfil" name="fk_perfil" id="fk_perfil">
        <?php foreach($PERFILES as $k => $row){?>
          <option value="<?=$row['pk_perfil']?>" <?=($INFO['fk_perfil'] == $row['pk_perfil']) ? "selected":""?>>
          <?=$row['descripcion']?></option>
        <?php }?>
      </select>
    </div>
    <div class="mb-3 col-md-4">
      <label for="nombre_usuario" class="col-form-label">Usuario:</label>
      <input type="text" class="form-control" name="nombre_usuario"  oninput="this.value = this.value.toLowerCase();this.value = this.value.trim();"
      id="nombre_usuario" value="<?=$INFO['nombre_usuario']?>" minlength="8" maxlength="20" required autocomplete="off">
    </div>
    <div class="mb-3 col-md-4">
      <div class="form-check" id="passwordUpdate">
        <input class="form-check-input" type="checkbox" value="" id="validarCambiarPass">
        <label class="form-check-label" for="validarCambiarPass">Cambiar Contraseña</label>
      </div>
      <label for="contrasena_usuario" class="col-form-label">Contraseña:</label>
      <input type="password" class="form-control" name="contrasena_usuario" oninput="this.value = this.value.toLowerCase();this.value = this.value.trim();"
      id="contrasena_usuario"value="<?=$INFO['contrasena_usuario']?>" minlength="8" maxlength="25" required autocomplete="off">
    </div>
    <div class="mb-3 col-md-4">
      <label for="nombre" class="col-form-label">Nombre:</label>
      <input type="text" class="form-control" name="nombre" id="nombre" value="<?=$INFO['nombre']?>" required autocomplete="off">
    </div>
    <div class="mb-3 col-md-4">
      <label for="apellido1" class="col-form-label">Apellido 1:</label>
      <input type="text" class="form-control" name="apellido1" id="apellido1" value="<?=$INFO['apellido1']?>" required autocomplete="off">
    </div>
    <div class="mb-3 col-md-4">
      <label for="apellido2" class="col-form-label">Apellido 2:</label>
      <input type="text" class="form-control" name="apellido2" id="apellido2" value="<?=$INFO['apellido2']?>" required autocomplete="off">
    </div>
    <div class="mb-3 col-md-4">
      <label for="telefono_usuario" class="col-form-label">Teléfono:</label>
      <input type="text" class="form-control" name="telefono_usuario" id="telefono_usuario" value="<?=$INFO['telefono_usuario']?>" autocomplete="off" maxlength="10">
    </div>
    <div class="mb-3 col-md-4">
      <label for="correo_usuario" class="col-form-label" >Correo:</label>
      <input type="text" class="form-control" name="correo_usuario" oninput="this.value = this.value.toLowerCase();this.value = this.value.trim();"
      id="correo_usuario" value="<?=$INFO['correo_usuario']?>" autocomplete="off" maxlength="150">
    </div>
    <div class="mb-3 col-md-4" id="fk_estatus2">
      <label for="fk_estatus" class="col-form-label">Estatus:</label>
      <select class="form-select chosen-select" aria-label="fk_estatus" name="fk_estatus" id="fk_estatus">
        <?php foreach($ESTATUS as $k => $row){?>
        <option value="<?=$row['pk_estatus']?>" <?=($INFO['fk_estatus'] == $row['pk_estatus']) ? "selected":""?>>
        <?=$row['descripcion']?></option>
        <?php }?>
      </select>
    </div>
  </div>
</form>
<script type="text/javascript">
$(document).ready(function () {
  $('.chosen-select').chosen({width:"200px", no_results_text: "No hay datos que coincidan con la búsqueda"});
});
$("#telefono_usuario").numeric({
	maxDigits: 10
});
if($("#pk_usuario").val() == "0"){
  $("#fk_estatus2").hide();
  $("#passwordUpdate").hide();
}
if($("#pk_usuario").val() != "0"){
  $("#nombre_usuario").attr('readonly', true);
  $("#contrasena_usuario").attr('disabled', true);
}
$("#validarCambiarPass").change(function() {
  if($(this).is(":checked")){
    $("#contrasena_usuario").attr('disabled', false);
  }else{
    $("#contrasena_usuario").attr('disabled', true);
  }
});
$("#nombre_usuario,#contrasena_usuario,#correo_usuario").change(function() {
let value = $(this).val();
let value_without_space = value.replace(/ /g, "");
$(this).val(value_without_space);
});
</script>