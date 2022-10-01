<?php include('common/header.php');?>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
		</div>
		<div class="col-sm-4 mt-3">
			<center class="mb-3">
			<img src="<?=base_url()?>assets/img/logo-idey.svg">
		    </center>
			<div class="card">
				<div class="card-body">
					<div id="output" class="<?=($this->session->flashdata("usuario_incorrecto") != "" || validation_errors() != "") ? 'alert alert-danger animated fadeInUp' : ''?>"><?=$this->session->flashdata("usuario_incorrecto")." ".validation_errors()?></div>
            		<form role="form" method="post" action="loggin" id="loginForm" autocomplete="off">
						<input type="hidden" name="<?=$tok_name?>" id="token" value="<?=$tok?>">
						<input type="hidden" name="recaptcha_response" id="recaptcha_response">
						<input type="hidden" name="login_recaptcha" id="login_recaptcha" value="<?=$recaptcha?>">
						<div class="mb-3">
							<label for="usuario" class="form-label">Usuario</label>
							<input type="text" class="form-control" value="" name="usuario" id="usuario" placeholder="Usuario" minlength="5" autocomplete="off">
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Contraseña</label>
							<div class="input-group mb-3">
								<input type="password" class="form-control"  value="" id="password" name="password" placeholder="Contraseña" required minlength="8" autocomplete="off">
								<span onclick="mostrarPassword()" class="input-group-text" id="basic-addon1"><i id="icon" class="bi bi-eye-slash"></i></span>
							</div>
						</div>
						<div class="d-grid gap-2 col-6 mx-auto">
							<button type="button" id="btnLogIn" class="btn btn-warning btn-lg">Acceder</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
		</div>
	</div>
</div>
<?php include('common/footer.php');?>
<script src='https://www.google.com/recaptcha/api.js?render=6Lf4zUgiAAAAANes7E3WZBBcZzrg-5xzm1PGlWHC'></script>
<!-- <script src='https://www.google.com/recaptcha/api.js?render=6LcEJ6QgAAAAAJsR1255Se6Rh_nQMNUH03iflSBr'></script> publica -->
<style>
	.footer{
		left:0 !important;
		text-align:center;
	}
</style>
<script>
function enviarForm(){
    let _flag = 0;
    if($.trim($("#usuario").val()).length == 0){
        _flag++;
    }
    if($.trim($("#password").val()).length == 0){
        _flag++;
    }
    if(_flag > 0){
        $("#btnLogIn").removeClass("disabled");
        $("#btnLogIn").prop("disabled",false);
		$.toast({allowToastClose:true, loader:true,icon:'error',position:'top-center',text:'Debe ingresar su usuario y contraseña',hideAfter:9900,heading:'Error' });
        return false;
    }
    let recaptcha = $.trim($("#login_recaptcha").val());
    grecaptcha.ready(function() {
        grecaptcha.execute(recaptcha, {action: 'acceso_web'}).then(function(token) {
			$.blockUI({ css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
            	opacity: .5,
            	color: '#fff' }, message: '<h1>Validando...</h1>', baseZ: 2000
			});
			$("#recaptcha_response").val(token);
            $('#loginForm').submit();
        });
    });
}
function mostrarPassword() {
	let cambio = document.getElementById("password");
	if(cambio.type == "password"){
		cambio.type = "text";
		$('#icon').removeClass('bi-eye-slash').addClass('bi-eye');
	}else{
		cambio.type = "password";
		$('#icon').removeClass('bi-eye').addClass('bi-eye-slash');
	}
}
$(document).ready( function(){
	setTimeout(() => {
		$("#usuario").focus();
	}, 500);
	$("#password").keydown(function (e) {
		if(e.keyCode == 13){
			$("#btnLogIn").addClass("disabled");
			$("#btnLogIn").prop("disabled",true);
			enviarForm();
		}
	});
	$("#btnLogIn").click( function(){
		$(this).blur();
		$(this).addClass("disabled");
		$(this).prop("disabled",true);
        enviarForm();
	});
});
</script>
