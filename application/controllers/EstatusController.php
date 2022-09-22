<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EstatusController extends My_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('EstatusModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'solicitudes');
		}
		$datos = $this->funcionesBasicas('Estatus');
		$datos['menu'] = "estatus";
		$this->load->view('estatus',$datos);
	}
	public function listEstatus(){
		$filtros = array('tipo' => 'TOTAL', 'start' => '0', 'limit' => '0');
		$count = $this->EstatusModel->EstatusModelo($filtros);
		$tmp = $this->input->post('page');
		$page = (!empty($tmp))?$tmp:1;
		$tmp = $this->input->post('rows');
		$limit = $filtros['limit'] = (!empty($tmp))?$tmp:10;
		$start = $limit * $page - $limit;
		$start = $filtros['start'] = ($start < 0) ? 0 : $start;
		$filtros['tipo'] = 'PARCIAL';
		$sidx = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sidx'] : 'pk_estatus';
		$sord = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sord'] : 'ASC';
		$filtros['sidx'] = $sidx;
		$filtros['sord'] = $sord;
		$dataControl = $this->EstatusModel->EstatusModelo($filtros);
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
			$response->rows[$i]['id'] = $row['pk_estatus'];
			$response->rows[$i]['cell'] = array('pk_estatus' => $row['pk_estatus'],
				"btnEditar" => '<button type="button" class="btn btn-labeled btn-primary btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="'.$row['pk_estatus'].'"><span class="btn-label"><i class="bi bi-pencil"></i></span>  Editar</button>',
				"descripcion" => $row['descripcion'],
			);
			$i++;
		}
		echo json_encode($response);die();
	}
	public function guardarEstatus(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array("error" => true,"msg" => 'Favor de actualizar la página, su sesión finalizó.'));die();
		}
		$descripcion = $this->input->post('descripcion');
		if(trim($descripcion) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Descripción es obligatorio'));die();
		}
		$res = $this->EstatusModel->estatusGuardar($_POST);
		echo json_encode($res);die();
	}
	public function loadFormulario(){
		$data['pk_estatus'] = $this->input->post('pk_estatus');
		$data['INFO']['descripcion'] = '';
		if(intval($data['pk_estatus']) > 0){//Editar
			$data['INFO'] = $this->EstatusModel->obtenerRegistroPorId($data['pk_estatus']);
		}
		echo json_encode(array("error" => false,"HTML" => $this->load->view("loads/estatusModal",$data,TRUE),"msg" => ''));die();
	}
}