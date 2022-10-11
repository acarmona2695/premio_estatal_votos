
<form id="form">

<div class="row">
<div class="col-md-10">
<label for="atleta" class="col-form-label">Deportista</label>
      <select class="form-select chosen-select" aria-label="atleta" name="atleta" id="atleta">
        <?php foreach($NOMINADOS as $k => $row){?>
          <option value="<?=$row['pk_nominado']?>" <?=($INFO['fk_nominado'] == $row['pk_nominado']) ? "selected":""?>>
          <?=$row['nombre_nominado']?></option>
        <?php }?>
      </select>
        </div>
        
<div class="col-md-2">
<br>
<button class="btn btn-primary" type="submit">3</button>
</div>
</div>

<br>

<div class="row">
<div class="col-md-10">
<label for="atleta" class="col-form-label">Deportista</label>
      <select class="form-select chosen-select" aria-label="atleta" name="atleta" id="atleta">
        <?php foreach($NOMINADOS as $k => $row){?>
          <option value="<?=$row['pk_nominado']?>" <?=($INFO['fk_nominado'] == $row['pk_nominado']) ? "selected":""?>>
          <?=$row['nombre_nominado']?></option>
        <?php }?>
      </select>
        </div>
        
<div class="col-md-2">
  <br>
<button class="btn btn-primary" type="submit">2</button>
</div>
</div>


<br>

<div class="row">
<div class="col-md-10">
<label for="atleta" class="col-form-label">Deportista</label>
      <select class="form-select chosen-select" aria-label="atleta" name="atleta" id="atleta">
        <?php foreach($NOMINADOS as $k => $row){?>
          <option value="<?=$row['pk_nominado']?>" <?=($INFO['fk_nominado'] == $row['pk_nominado']) ? "selected":""?>>
          <?=$row['nombre_nominado']?></option>
        <?php }?>
      </select>
        </div>
        
<div class="col-md-2">
  <br>
<button class="btn btn-primary" type="submit">1</button>
</div>
</div>

</form>


       