<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AsociacionController extends My_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('AsociacionModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'solicitudes');
		}
		$datos = $this->funcionesBasicas('Asociacion');
		$datos['menu'] = "asociacion";
		$this->load->view('asociacion',$datos);
	}
	public function listAsociacion(){
		$filtros = array('tipo' => 'TOTAL', 'start' => '0', 'limit' => '0');
		$count = $this->AsociacionModel->AsociacionModelo($filtros);
		$tmp = $this->input->post('page');
		$page = (!empty($tmp))?$tmp:1;
		$tmp = $this->input->post('rows');
		$limit = $filtros['limit'] = (!empty($tmp))?$tmp:10;
		$start = $limit * $page - $limit;
		$start = $filtros['start'] = ($start < 0) ? 0 : $start;
		$filtros['tipo'] = 'PARCIAL';
		$sidx = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sidx'] : 'pk_asociacion';
		$sord = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sord'] : 'ASC';
		$filtros['sidx'] = $sidx;
		$filtros['sord'] = $sord;
		$dataControl = $this->AsociacionModel->AsociacionModelo($filtros);
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
			$response->rows[$i]['id'] = $row['pk_asociacion'];
			$response->rows[$i]['cell'] = array('pk_asociacion' => $row['pk_asociacion'],
				"btnEditar" => '<button type="button" class="btn btn-labeled btn-primary btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="'.$row['pk_asociacion'].'"><span class="btn-label"><i class="bi bi-pencil"></i></span>  Editar</button>',
				"nombre_asociacion" => $row['nombre_asociacion'],
			);
			$i++;
		}
		echo json_encode($response);die();
	}
	public function guardarAsociacion(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array("error" => true,"msg" => 'Favor de actualizar la página, su sesión finalizó.'));die();
		}
		$nombre_asociacion = $this->input->post('nombre_asociacion');
		if(trim($nombre_asociacion) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Asociación es obligatorio'));die();
		}
		$res = $this->AsociacionModel->AsociacionGuardar($_POST);
		echo json_encode($res);die();
	}
	public function loadFormulario(){
		$data['pk_asociacion'] = $this->input->post('pk_asociacion');
		$data['INFO']['nombre_asociacion'] = '';
		if(intval($data['pk_asociacion']) > 0){//Editar
			$data['INFO'] = $this->AsociacionModel->obtenerRegistroPorId($data['pk_asociacion']);
		}
		echo json_encode(array("error" => false,"HTML" => $this->load->view("loads/asociacionModal",$data,TRUE),"msg" => ''));die();
	}
}