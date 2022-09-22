<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PerfilController extends My_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('PerfilModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'solicitudes');
		}
		$datos = $this->funcionesBasicas('Perfil');
		$datos['menu'] = "perfil";
		$this->load->view('perfil',$datos);
	}
	public function listPerfil(){
		$filtros = array('tipo' => 'TOTAL', 'start' => '0', 'limit' => '0');
		$count = $this->PerfilModel->PerfilModelo($filtros);
		$tmp = $this->input->post('page');
		$page = (!empty($tmp))?$tmp:1;
		$tmp = $this->input->post('rows');
		$limit = $filtros['limit'] = (!empty($tmp))?$tmp:10;
		$start = $limit * $page - $limit;
		$start = $filtros['start'] = ($start < 0) ? 0 : $start;
		$filtros['tipo'] = 'PARCIAL';
		$sidx = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sidx'] : 'pk_perfil';
		$sord = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sord'] : 'ASC';
		$filtros['sidx'] = $sidx;
		$filtros['sord'] = $sord;
		$dataControl = $this->PerfilModel->PerfilModelo($filtros);
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
			$response->rows[$i]['id'] = $row['pk_perfil'];
			$response->rows[$i]['cell'] = array('pk_perfil' => $row['pk_perfil'],
				"btnEditar" => '<button type="button" class="btn btn-labeled btn-primary btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="'.$row['pk_perfil'].'"><span class="btn-label"><i class="bi bi-pencil"></i></span>  Editar</button>',
				"descripcion" => $row['descripcion'],
				"comentarios" => $row['comentarios'],
			);
			$i++;
		}
		echo json_encode($response);die();
	}
	public function guardarPerfil(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array("error" => true,"msg" => 'Favor de actualizar la página, su sesión finzalizó.'));die();
		}
		$descripcion = $this->input->post('descripcion');
		if(trim($descripcion) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Descripción es obligatorio'));die();
		}

		$comentarios = $this->input->post('comentarios');
		if(trim($comentarios) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Comentarios es obligatorio'));die();
		}
		$res = $this->PerfilModel->perfilGuardar($_POST);
		echo json_encode($res);die();
	}
	public function loadFormulario(){
		$data['pk_perfil'] = $this->input->post('pk_perfil');
		$data['INFO']['descripcion'] = '';
		$data['INFO']['comentarios'] = '';
		if(intval($data['pk_perfil']) > 0){//Editar
			$data['INFO'] = $this->PerfilModel->obtenerRegistroPorId($data['pk_perfil']);
		}
		echo json_encode(array("error" => false,"HTML" => $this->load->view("loads/perfilModal",$data,TRUE),"msg" => ''));die();
	}
}