<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EntrenadorController extends My_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('EntrenadorModel');
		$this->load->model('RegistroADModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'solicitudes');
		}
		$datos = $this->funcionesBasicas('Entrenador');
		$datos['menu'] = "entrenador";
		$datos['ASOCIACION'] = $this->RegistroADModel->listAsociacion();
		$datos['DISCIPLINA'] = $this->RegistroADModel->listDisciplina();
		$this->load->view('entrenador',$datos);
	}
	public function listEntrenador(){

		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array());
			die();
		}
		$filtros = array('tipo' => 'TOTAL', 'start' => '0', 'limit' => '0');
		$count = $this->EntrenadorModel->EntrenadorModelo($filtros);
		$tmp = $this->input->post('page');
		$page = (!empty($tmp))?$tmp:1;
		$tmp = $this->input->post('rows');
		$limit = $filtros['limit'] = (!empty($tmp))?$tmp:10;
		$start = $limit * $page - $limit;
		$start = $filtros['start'] = ($start < 0) ? 0 : $start;
		$filtros['tipo'] = 'PARCIAL';
		$sidx = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sidx'] : 'pk_entrenador';
		$sord = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sord'] : 'ASC';
		$filtros['sidx'] = $sidx;
		$filtros['sord'] = $sord;
		$dataControl = $this->EntrenadorModel->EntrenadorModelo($filtros);
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
			$response->rows[$i]['id'] = $row['pk_entrenador'];
			$response->rows[$i]['cell'] = array('pk_entrenador' => $row['pk_entrenador'],
				"btnEditar" => '<button type="button" class="btn btn-labeled btn-primary btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="'.$row['pk_entrenador'].'"><span class="btn-label"><i class="bi bi-pencil"></i></span>  Editar</button>',
				"nombre_entrenador" => $row['nombre_entrenador'],
				"fk_asociacion" => $row['fk_asociacion'],
				"fk_disciplina" => $row['fk_disciplina'],
			
			);
			$i++;
		}
		echo json_encode($response);die();
	}
	public function guardarEntrenador(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array("error" => true,"msg" => 'Favor de actualizar la página, su sesión finzalizó.'));die();
		}
		$nombre_entrenador = $this->input->post('nombre_entrenador');
		if(trim($nombre_entrenador) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Nombre  Entrenador es obligatorio'));die();
		}
		$fk_asociacion = $this->input->post('fk_asociacion');
		if(trim($fk_asociacion) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Asociación es obligatorio'));die();
		}
		$fk_disciplina = $this->input->post('fk_disciplina');
		if(trim($fk_disciplina) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Disciplina es obligatorio'));die();
		}

		
		$res = $this->EntrenadorModel->entrenadorGuardar($_POST);
		echo json_encode($res);die();
	}
	public function loadFormulario(){
		$data['pk_entrenador'] = $this->input->post('pk_entrenador');
		$data['INFO']['nombre_entrenador'] = '';
		$data['INFO']['fk_asociacion'] = '';
		$data['INFO']['fk_disciplina'] = '';
	
		if(intval($data['pk_entrenador']) > 0){//Editar
			$data['INFO'] = $this->EntrenadorModel->obtenerRegistroPorId($data['pk_entrenador']);
		}

		$data['ASOCIACION'] = $this->RegistroADModel->listAsociacion();
		$data['DISCIPLINA'] = $this->RegistroADModel->listDisciplina();


		echo json_encode(array("error" => false,"HTML" => $this->load->view("loads/entrenadorModal",$data,TRUE),"msg" => ''));die();
	}
}