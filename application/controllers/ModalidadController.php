<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ModalidadController extends My_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('ModalidadModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'solicitudes');
		}
		$datos = $this->funcionesBasicas('Modalidad');
		$datos['menu'] = "modalidad";
		$this->load->view('modalidad',$datos);
	}
	public function listModalidad(){
		$filtros = array('tipo' => 'TOTAL', 'start' => '0', 'limit' => '0');
		$count = $this->ModalidadModel->ModalidadModelo($filtros);
		$tmp = $this->input->post('page');
		$page = (!empty($tmp))?$tmp:1;
		$tmp = $this->input->post('rows');
		$limit = $filtros['limit'] = (!empty($tmp))?$tmp:10;
		$start = $limit * $page - $limit;
		$start = $filtros['start'] = ($start < 0) ? 0 : $start;
		$filtros['tipo'] = 'PARCIAL';
		$sidx = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sidx'] : 'pk_modalidad';
		$sord = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sord'] : 'ASC';
		$filtros['sidx'] = $sidx;
		$filtros['sord'] = $sord;
		$dataControl = $this->ModalidadModel->ModalidadModelo($filtros);
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
			$response->rows[$i]['id'] = $row['pk_modalidad'];
			$response->rows[$i]['cell'] = array('pk_modalidad' => $row['pk_modalidad'],
				"btnEditar" => '<button type="button" class="btn btn-labeled btn-primary btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="'.$row['pk_modalidad'].'"><span class="btn-label"><i class="bi bi-pencil"></i></span>  Editar</button>',
				"nombre_modalidad" => $row['nombre_modalidad'],
			);
			$i++;
		}
		echo json_encode($response);die();
	}
	public function guardarModalidad(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array("error" => true,"msg" => 'Favor de actualizar la página, su sesión finalizó.'));die();
		}
		$nombre_modalidad = $this->input->post('nombre_modalidad');
		if(trim($nombre_modalidad) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Modalidad es obligatorio'));die();
		}
		$res = $this->ModalidadModel->ModalidadGuardar($_POST);
		echo json_encode($res);die();
	}
	public function loadFormulario(){
		$data['pk_modalidad'] = $this->input->post('pk_modalidad');
		$data['INFO']['nombre_modalidad'] = '';
		if(intval($data['pk_modalidad']) > 0){//Editar
			$data['INFO'] = $this->ModalidadModel->obtenerRegistroPorId($data['pk_modalidad']);
		}
		echo json_encode(array("error" => false,"HTML" => $this->load->view("loads/modalidadModal",$data,TRUE),"msg" => ''));die();
	}
}