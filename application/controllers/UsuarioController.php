<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UsuarioController extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('UsuarioModel');
		$this->load->model('CatalogoModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'solicitudes');
		}
		$datos = $this->funcionesBasicas('Usuario');
		$datos['menu'] = "usuario";
		$datos['PERFILES'] = $this->CatalogoModel->listPerfiles();
		$datos['ESTATUS'] = $this->CatalogoModel->listEstatus();
		$this->load->view('usuario',$datos);
	}
	public function listUsuario(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array());
			die();
		}
		$filtros = array('tipo' => 'TOTAL', 'start' => '0', 'limit' => '0');
		$filtros['LIKE'] = array("usuario" => trim($this->input->post("usuario")),
								"nombre" => trim($this->input->post("nombre")));
		$filtros['WHERE'] = array("perfil" => trim($this->input->post("perfil")),
									"fecha" => trim($this->input->post("fecha")),
									"estatus" => trim($this->input->post("estatus")));
		$count = $this->UsuarioModel->UsuarioModelo($filtros);
		$tmp = $this->input->post('page');
		$page = (!empty($tmp))?$tmp:1;
		$tmp = $this->input->post('rows');
		$limit = $filtros['limit'] = (!empty($tmp))?$tmp:10;
		$start = $limit * $page - $limit;
		$start = $filtros['start'] = ($start < 0) ? 0 : $start;
		$filtros['tipo'] = 'PARCIAL';
		$sidx = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sidx'] : 'pk_usuario';
		$sord = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sord'] : 'ASC';
		$filtros['sidx'] = $sidx;
		$filtros['sord'] = $sord;
		$dataControl = $this->UsuarioModel->UsuarioModelo($filtros);
		if($count > 0){
			$total_pages = ceil($count/$limit);
		}else{
			$total_pages = 0;
		}
		if ($page > $total_pages){
			$page=$total_pages;
		}
		$response = new stdClass();
		$response->page = $page;
		$response->total = $total_pages;
		$response->records = $count;
		if(count($dataControl) == 0){
			echo json_encode(array());
			die();
		}
		$i=0;
		foreach($dataControl as $row){
			$response->rows[$i]['id'] = $row['pk_usuario'];
			$response->rows[$i]['cell'] = array('pk_usuario' => $row['pk_usuario'],
				"btnEditar" => '<button type="button" class="btn btn-labeled btn-primary btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="'.$row['pk_usuario'].'"><span class="btn-label"><i class="bi bi-pencil"></i></span>  Editar</button>',
				"perfil_usuario" => $row['perfil_usuario'],
				"nombre_usuario" => $row['nombre_usuario'],
				"nombre" => $row['nombre'],
				"apellido1" => $row['apellido1'],
				"apellido2" => $row['apellido2'],
				"correo_usuario" => $row['correo_usuario'],
				"telefono_usuario" => $row['telefono_usuario'],
				"fecha_creacion" => $row['fecha_creacion'],
				"fecha_modificacion" => $row['fecha_modificacion'],
				"fechaUltimoAcceso" => $row['fechaUltimoAcceso'],
				"estatus" => $row['estatus'],
			);
			$i++;
		}
		echo json_encode($response);die();
	}
	public function guardarUsuario(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array("error" => true,"msg" => 'Favor de actualizar la página, su sesión finzalizó.'));die();
		}
		$fk_perfil = $this->input->post('fk_perfil');
		if(trim($fk_perfil) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Perfil es obligatorio'));die();
		}

		$nombre_usuario = $this->input->post('nombre_usuario');
		if(trim($nombre_usuario) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Usuario es obligatorio'));die();
		}
		if(strlen(trim($nombre_usuario)) < 8 || strlen(trim($nombre_usuario)) > 20){
			echo json_encode(array("error" => true,"msg" => 'El campo Usuario debe tener mínimo 8 caracteres y un máximo de 20 caracteres'));die();
		}
		$pk_usuario = $this->input->post('pk_usuario');
		if($pk_usuario == 0){
			$validarUsuarioExistente = $this->UsuarioModel->validarUsuarioExistente($nombre_usuario);
			if($validarUsuarioExistente > 1){
				echo json_encode(array("error" => true,"msg" => 'El Usuario ya existe, favor de verificar la información'));die();
			}
		}
		$contrasena_usuario = $this->input->post('contrasena_usuario');
		if(trim($contrasena_usuario) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Contraseña es obligatorio'));die();
		}
		if(strlen(trim($contrasena_usuario)) < 8 || strlen(trim($contrasena_usuario)) > 25 ){
			echo json_encode(array("error" => true,"msg" => 'El campo Contraseña debe tener mínimo 8 caracteres y un máximo de 25 caracteres'));die();
		}
		$nombre = $this->input->post('nombre');
		if(trim($nombre) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Nombre es obligatorio'));die();
		}
		$apellido1 = $this->input->post('apellido1');
		if(trim($apellido1) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Apellido 1 es obligatorio'));die();
		}
		$apellido2 = $this->input->post('apellido2');
		$telefono_usuario = $this->input->post('telefono_usuario');
		if(trim($telefono_usuario) != ""){
			if(strlen(trim($telefono_usuario)) > 30){
			echo json_encode(array("error" => true,"msg" => 'El campo Teléfono no debe de tener más 10 dígitos'));die();
			}
		}
		$correo_usuario = $this->input->post('correo_usuario');
		if(trim($correo_usuario) != ""){
			if(strlen(trim($correo_usuario)) > 150){
			echo json_encode(array("error" => true,"msg" => 'El campo Correo no debe de tener más 150 caracteres'));die();
			}
		}
		$fk_estatus = $this->input->post('fk_estatus');
		if(trim($fk_estatus) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Estatus es obligatorio'));die();
		}
		if(trim($contrasena_usuario) == "nocambia"){
			$datos['pk_usuario'] = $this->input->post('pk_usuario');
			$datos['nombre_usuario'] = trim($nombre_usuario);
			$datos['nombre'] = trim($nombre);
			$datos['apellido1'] = trim($apellido1);
			$datos['apellido2'] = trim($apellido2);
			$datos['telefono_usuario'] = trim($telefono_usuario);
			$datos['correo_usuario'] = trim($correo_usuario);
			$datos['fk_estatus'] = $fk_estatus;
			$datos['fk_perfil'] = $fk_perfil;
			$res = $this->UsuarioModel->usuarioGuardar($datos);
		 	echo json_encode($res);die();
		}else{
			$_POST['contrasena_usuario'] = sha1(trim($contrasena_usuario));
		}
		/*$correo = $this->input->post('correo_usuario');
		$subject = "Registro de usuario";
		$msg = '
					<table cellpadding="0" cellspacing="0" class="wrapper"  width="100%">
						<tbody>
							<tr>
								<td align="center">
									<table cellpadding="0" cellspacing="0" width="100%">
										<tbody>
											<tr>
												<td cellpadding="0" cellspacing="0" class="body"  width="100%">
													<table align="center" cellpadding="0" cellspacing="0" class="inner-body" id="tablaMailBody" width="570">
														<tbody>
															<tr>
																<td style="box-sizing: border-box; text-align: center; width: 40px;">
																	<img src="https://web-developers.com.mx/img/madev.ico"/>
																</td>
															</tr>
															<tr style="padding: 0;">
																<td style="box-sizing: border-box; border-bottom-color: #a1a1a1; border-bottom-style: solid; border-bottom-width: 5px; padding-top: 15px;"></td>
															</tr>
															<tr style="padding: 0;">
																<td>
																	<p style="font-size:50px; font-family:Barlow;box-sizing: border-box;color: black;line-height: 1.5em;margin-top: 0;text-align: center;font-size: 22px;padding-top: 10px;">PROGRAMA DIRECTORIO</p>
																</td>
															</tr>
															<tr>
																<td>
																	<p style="font-size:50px; font-family:Barlow;box-sizing: border-box;color: black;line-height: 1.5em;margin-top: 0;text-align: center;font-size: 22px;padding-top: 10px;">Hola '.$nombre.' '.$apellido1.'</p>
																</td>
															<tr>
															<tr>
																<td>
																	<p style="font-size:50px; font-family:Barlow;box-sizing: border-box;color: black;line-height: 1.5em;margin-top: 0;text-align: center;font-size: 22px;padding-top: 10px;">El usuario se registró con éxito.</p>
																</td>
															<tr>
															<tr>
																<td>
																	<p style="font-size:50px; font-family:Barlow;box-sizing: border-box;color: black;line-height: 1.5em;margin-top: 0;text-align: center;font-size: 22px;padding-top: 10px;">Tu usuario es :<br/>
																	'.$nombre_usuario.'</p>
																</td>
															<tr>
															<tr>
																<td>
																	<p style="font-size:50px; font-family:Barlow;box-sizing: border-box;color: black;line-height: 1.5em;margin-top: 0;text-align: center;font-size: 22px;padding-top: 10px;">Contraseña: '.$contrasena_usuario.' te sugerimos cambiarla lo mas pronto posible.<br/></p>
																</td>
															<tr>
															<tr>
																<td>
																	<p style="font-size:50px; font-family:Barlow;box-sizing: border-box;color: black;line-height: 1.5em;margin-top: 0;text-align: center;font-size: 22px;padding-top: 10px;">¡Gracias por tu confianza!</p>
																</td>
															</tr>
															<tr>
																<td style="box-sizing: border-box; border-bottom-color: #a1a1a1; border-bottom-style: solid; border-bottom-width: 5px; padding-top: 15px;"></td>
															</tr>
															<tr>
																<td >
																	<p style="font-family: Barlow; box-sizing: border-box; color: rgb(116, 120, 126); line-height: 1.5em; margin-top: 0px; font-size: 15px; padding-top: 10px; text-align: center;">Este correo es informativo, por favor no respondas, no está habilitado para recibir mensajes.</p>
																</td>
															</tr>
															<tr>
																<td >
																	<p style="font-family: Barlow; box-sizing: border-box; color: rgb(116, 120, 126); line-height: 1.5em; margin-top: 0px; font-size: 15px; text-align: center;"><a href="https://web-developers.com.mx/madev/></a></p>
																</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>';
		$this->enviarCorreo($correo,$msg,$subject);*/
		$res = $this->UsuarioModel->usuarioGuardar($_POST);
		echo json_encode($res);die();
	}
	public function loadFormulario(){
		$data['pk_usuario'] = $this->input->post('pk_usuario');
		$data['INFO']['nombre_usuario'] = '';
		$data['INFO']['contrasena_usuario'] = '';
		$data['INFO']['nombre'] = '';
		$data['INFO']['apellido1'] = '';
		$data['INFO']['apellido2'] = '';
		$data['INFO']['telefono_usuario'] = '';
		$data['INFO']['correo_usuario'] = '';
		$data['INFO']['fk_estatus'] = '';
		$data['INFO']['fk_perfil'] = '';
		if(intval($data['pk_usuario']) > 0){//Editar
			$data['INFO'] = $this->UsuarioModel->obtenerRegistroPorId($data['pk_usuario']);
			$data['INFO']['contrasena_usuario'] = '';
		}
		$data['ESTATUS'] = $this->CatalogoModel->listEstatus();
		$data['PERFILES'] = $this->CatalogoModel->listPerfiles();
		//echo json_encode($data);die();
		echo json_encode(array("error" => false,"HTML" => $this->load->view("loads/usuarioModal",$data,TRUE),"msg" => ''));die();
	}

	public function enviarCorreo($correo = '',$msg = '',$subject = ''){
		if($correo != ""){
			$this->load->library("MailerG");
			$mail = $this->mailerg->load();
			$mail->CharSet = 'UTF-8';
			$mail->SMTPAutoTLS = true;
			$mail->isSMTP();
			$mail->SMTPAuth = true;
			/*$mail->Host     = 'notificaciones.yucatan.gob.mx';
			$mail->Username = 'educacion';
			$mail->Password = 'Vse76PZD8WU5u9zO';*/
			$mail->Host     = 'mail.sigeyucatan.gob.mx';
			$mail->Username = 'selecciondocente@sigeyucatan.gob.mx';
			$mail->Password = 'UziK4mM2k2!';
			$mail->SMTPSecure = 'tls';
			$mail->Port     = 587;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			//$mail->setFrom('educacion@notificaciones.yucatan.gob.mx', 'Becas');
			$mail->setFrom('selecciondocente@sigeyucatan.gob.mx', 'MADEV MID');
			$mail->isHTML(true);
			$mail->addAddress($correo);
			$mail->Subject = $subject;
			$mensaje = "<p>".$msg."</p><br/>
			";
			$mail->Body = $mensaje;
			if(!$mail->send()){
				echo json_encode(array("error" => true, "msg" => "El correo no se envio."));
				die();
			}
		}
	}
}