<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	const CLAVE_SECRET = "6LfivhQiAAAAAMMg-5CQL0UiJLV3GJljLD04ilTl";
	const CLAVE_PUBLIC = "6LfivhQiAAAAANjuappTr-WLDOW7GIp0m_H_zVcS";
	// const CLAVE_SECRET = "6Lfr5WggAAAAAMKXIdorcSSOT1uDlP8jUyRLtuyt";
	// const CLAVE_PUBLIC = "6Lfr5WggAAAAAMp5mWNkShmhAOH7pKSyDrHMBCjt";
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('America/Mexico_City');
		$this->load->model('M_login');
		$this->load->helper(array('url','form'));
		$this->load->library(array('form_validation'));
	}
	public function index(){
		if($this->session->userdata('pb_LogIn') != false){
			redirect('usuario','');
		}
		$data = array();
		$data['tok'] = $this->security->get_csrf_hash();
		$data['tok_name'] = $this->security->get_csrf_token_name();
		$data['SECCIONACTUAL'] = 'Inicio de sesión';
		$data['msg'] = 'Error';
		$data['rem'] = 0;
		$data['recaptcha'] = self::CLAVE_PUBLIC;
		$this->load->view('login',$data);
	}
	public function vistaContrasena(){
		if($this->session->userdata('pb_LogIn')){
			$datos = array();
			$datos['SECCIONACTUAL'] = "Cambiar Contraseña";
			$datos['tok'] = $this->security->get_csrf_hash();
			$datos['tok_name'] = $this->security->get_csrf_token_name();
			$datos['ramdon'] = time();
			$datos['pk_usuario'] = $this->session->userdata('pb_idUsuario');
			$datos['idPerfil'] = $this->session->userdata('pb_idPerfil');
			$datos['menu'] = "contrasena";
			$this->load->view('contrasena',$datos);
		}
	}
	public function guardarContrasena(){
		if(!$this->session->userdata('pb_LogIn')){
			echo json_encode(array("error" => true,"msg" => 'Favor de actualizar la página, su sesión finalizó'));die();
		}
		$contrasena_usuario = $this->input->post('contrasena_usuario');
		if(trim($contrasena_usuario) == ''){
			echo json_encode(array("error" => true,"msg" => 'El campo Nueva contraseña es obligatorio'));die();
		}
		if(strlen(trim($contrasena_usuario)) < 8){
			echo json_encode(array("error" => true,"msg" => 'El campo Nueva contraseña debe de ser igual o mayor a 8 caracteres'));die();
		}
		$res = $this->M_login->contrasenaGuardar($_POST);
		echo json_encode($res);die();
	}
	public function loginUser(){
		$tokenGoogle = $this->input->post('recaptcha_response');
		if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['recaptcha_response'])){
			$cu = curl_init();
			curl_setopt($cu, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($cu, CURLOPT_POST, 1);
			curl_setopt($cu, CURLOPT_POSTFIELDS, http_build_query(array('secret' => self::CLAVE_SECRET, 'response' => $tokenGoogle)));
			curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($cu);
			curl_close($cu);
			$datos = json_decode($response, true);
			if($datos['success'] == 1 && $datos['score'] >= 0.5){
				$this->form_validation->set_rules('usuario', 'Usuario', 'required|trim|min_length[5]|max_length[80]',
				array("required" => "El campo <strong>%s</strong> es requerido",
					"min_length" => "El campo <strong>%s</strong> debe tener al menos 5 carácteres",
					"max_length" => "El campo <strong>%s</strong> no debe tener más de 80 carácteres",)
				);
				$this->form_validation->set_rules('password', 'Contraseña', 'required|trim|min_length[8]|max_length[30]',
					array("required" => "El campo <strong>%s</strong> es requerido",
					"min_length" => "El campo <strong>%s</strong> debe tener al menos 8 carácteres",
					"max_length" => "El campo <strong>%s</strong> no debe tener más de 30 carácteres")
				);
				if($this->form_validation->run() == FALSE){
					$this->index();
				}else{
					$username = trim($this->input->post('usuario'));
					$password = trim($this->input->post('password'));
					$check_user = $this->M_login->checkLogIn($username,$password);
					if(count($check_user) > 0){//El usuario existe y está activo
						$data = array(
							'pb_LogIn' => TRUE,
							'pb_idUsuario' => $check_user[0]['pk_usuario'],
							'pb_idPerfil' => $check_user[0]['fk_perfil'],
							'pb_perfil' => $check_user[0]['perfil_usuario'],
							'pb_usuario' => $check_user[0]['nombre_usuario'],
							'pb_nombre' => $check_user[0]['nombre']
						);
						$this->session->set_userdata($data);
						$url = "inicio";
						//echo json_encode($data);die();
						redirect(base_url().$url, 'refresh');
					}else{
						$this->session->set_flashdata('usuario_incorrecto','El Usuario o Contraseña no son válidos.');
						redirect(base_url(),'refresh');
					}
				}
			}else{
				$this->session->set_flashdata('usuario_incorrecto','El token del captcha es incorrecto.');
				redirect(base_url(),'refresh');
			}
		}else{
			$this->session->set_flashdata('usuario_incorrecto','El token del captcha es incorrecto.');
			redirect(base_url(),'refresh');
		}
	}
	public function errorCsrf(){
		$this->session->sess_destroy();
		$this->session->unset_userdata(array('usuario_incorrecto'=> NULL));
		$this->session->set_flashdata('usuario_incorrecto','<i class="fa fa-warning"></i> <strong> El token de seguridad ha caducado:</strong><br/>Esto se puede deber a que el tiempo de inactividad fue prolongado. Para continuar vuelva a ingresar sus datos.');
		$data = array();
		$data['tok'] = $this->security->get_csrf_hash();
		$data['tok_name'] = $this->security->get_csrf_token_name();
		$data['SECCIONACTUAL'] = 'Inicio de sesión';
		$data['msg'] = '';
		$data['rem'] = 0;
		$data['recaptcha'] = self::CLAVE_PUBLIC;
		$this->load->view('login',$data);
	}
	public function errorCsrf2(){
		$this->session->sess_destroy();
		echo json_encode(array('error' => true, 'HTML' => '<div class="bd-callout bd-callout-warning"><p><code>Sistema:</code></p><h4>Favor de actualizar la página, su sesión finalizó.</h4></div>', 'msg' => 'Favor de actualizar la página','tipo' => 4));
		die();
	}
	public function logoutUser(){
		session_unset();
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}
}
