<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DisciplinaController extends My_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('DisciplinaModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'solicitudes');
		}
		$datos = $this->funcionesBasicas('Disciplina');
		$datos['menu'] = "disciplina";
		$this->load->view('disciplina',$datos);
	}
	public function listDisciplina(){
		$filtros = array('tipo' => 'TOTAL', 'start' => '0', 'limit' => '0');
		$count = $this->DisciplinaModel->DisciplinaModelo($filtros);
		$tmp = $this->input->post('page');
		$page = (!empty($tmp))?$tmp:1;
		$tmp = $this->input->post('rows');
		$limit = $filtros['limit'] = (!empty($tmp))?$tmp:10;
		$start = $limit * $page - $limit;
		$start = $filtros['start'] = ($start < 0) ? 0 : $start;
		$filtros['tipo'] = 'PARCIAL';
		$sidx = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sidx'] : 'pk_disciplina';
		$sord = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sord'] : 'ASC';
		$filtros['sidx'] = $sidx;
		$filtros['sord'] = $sord;
		$dataControl = $this->DisciplinaModel->DisciplinaModelo($filtros);
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
			$response->rows[$i]['id'] = $row['pk_disciplina'];
			$response->rows[$i]['cell'] = array('pk_disciplina' => $row['pk_disciplina'],
				"btnEditar" => '<button type="button" class="btn btn-labeled btn-primary btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="'.$row['pk_disciplina'].'"><span class="btn-label"><i class="bi bi-pencil"></i></span>  Editar</button>',
				"nombre_disciplina" => $row['nombre_disciplina'],
			);
			$i++;
		}
		echo json_encode($response);die();
	}
	public function guardarDisciplina(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array("error" => true,"msg" => 'Favor de actualizar la página, su sesión finalizó.'));die();
		}
		$nombre_disciplina = $this->input->post('nombre_disciplina');
		if(trim($nombre_disciplina) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Disciplina es obligatorio'));die();
		}
		$res = $this->DisciplinaModel->DisciplinaGuardar($_POST);
		echo json_encode($res);die();
	}
	public function loadFormulario(){
		$data['pk_disciplina'] = $this->input->post('pk_disciplina');
		$data['INFO']['nombre_disciplina'] = '';
		if(intval($data['pk_disciplina']) > 0){//Editar
			$data['INFO'] = $this->DisciplinaModel->obtenerRegistroPorId($data['pk_disciplina']);
		}
		echo json_encode(array("error" => false,"HTML" => $this->load->view("loads/disciplinaModal",$data,TRUE),"msg" => ''));die();
	}
}