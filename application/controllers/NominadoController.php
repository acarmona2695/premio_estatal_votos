<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NominadoController extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('NominadoModel');
		$this->load->model('RegistroModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'nominado');
		}
		$datos = $this->funcionesBasicas('Nominado');
		$datos['menu'] = "nominado";
		$datos['ASOCIACION'] = $this->RegistroModel->listAsociacion();
		$datos['MODALIDAD'] = $this->RegistroModel->listModalidad();
		$this->load->view('nominado',$datos);
	}
	public function listNominado(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array());
			die();
		}
		$filtros = array('tipo' => 'TOTAL', 'start' => '0', 'limit' => '0');
		$filtros['LIKE'] = array("nombre" => trim($this->input->post("nombre")));
		$filtros['WHERE'] = array("asociacion" => trim($this->input->post("asociacion")),
									"modalidad" => trim($this->input->post("modalidad")));
		$count = $this->NominadoModel->NominadoModelo($filtros);
		$tmp = $this->input->post('page');
		$page = (!empty($tmp))?$tmp:1;
		$tmp = $this->input->post('rows');
		$limit = $filtros['limit'] = (!empty($tmp))?$tmp:10;
		$start = $limit * $page - $limit;
		$start = $filtros['start'] = ($start < 0) ? 0 : $start;
		$filtros['tipo'] = 'PARCIAL';
		$sidx = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sidx'] : 'pk_nominado';
		$sord = (isset($_POST['sidx']) && $_POST['sidx'] != "") ? $_POST['sord'] : 'ASC';
		$filtros['sidx'] = $sidx;
		$filtros['sord'] = $sord;
		$dataControl = $this->NominadoModel->NominadoModelo($filtros);
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
			$response->rows[$i]['id'] = $row['pk_nominado'];
			$response->rows[$i]['cell'] = array('pk_nominado' => $row['pk_nominado'],
				"btnEditar" => '<button type="button" class="btn btn-labeled btn-primary btn-sm btnEditar" data-bs-toggle="modal" data-bs-target="#modalInventario" data-id="'.$row['pk_nominado'].'"><span class="btn-label"><i class="bi bi-pencil"></i></span>  Editar</button>',
				"asociacion" => $row['asociacion'],
				"nombre_nominado" => $row['nombre_nominado'],
				"nombre_usuario" => $row['nombre_usuario'],
				"fecha_creacion" => $row['fecha_creacion'],
				"fecha_modificacion" => $row['fecha_modificacion'],
				"modalidad" => $row['modalidad'],
				"estatus" => $row['estatus'],
			);
			$i++;
		}
		echo json_encode($response);die();
	}
	public function guardarNominado(){
		if(!$this->session->userdata('pb_idUsuario')){
			echo json_encode(array("error" => true,"msg" => 'Favor de actualizar la página, su sesión finzalizó.'));die();
		}
		$nombre_nominado = $this->input->post('nombre_nominado');
		if(trim($nombre_nominado) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Nombre es obligatorio'));die();
		}
		$fk_asociacion = $this->input->post('fk_asociacion');
		if(trim($fk_asociacion) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Asociación es obligatorio'));die();
		}
		$fk_modalidad = $this->input->post('fk_modalidad');
		if(trim($fk_modalidad) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Modalidad es obligatorio'));die();
		}
		$estatus = $this->input->post('estatus');
		if(trim($estatus) == ""){
			echo json_encode(array("error" => true,"msg" => 'El campo Estatus es obligatorio'));die();
		}
		
		$res = $this->NominadoModel->NominadoGuardar($_POST);
		echo json_encode($res);die();
	}
	public function loadFormulario(){
		$data['pk_nominado'] = $this->input->post('pk_nominado');
		$data['INFO']['nombre_nominado'] = '';
		$data['INFO']['estatus'] = '';
		$data['INFO']['fk_asociacion'] = '';
		$data['INFO']['fk_modalidad'] = '';
		if(intval($data['pk_nominado']) > 0){//Editar
			$data['INFO'] = $this->NominadoModel->obtenerRegistroPorId($data['pk_nominado']);
			
		}
		$data['ASOCIACION'] = $this->RegistroModel->listAsociacion();
		$data['MODALIDAD'] = $this->RegistroModel->listModalidad();
		//echo json_encode($data);die();
		echo json_encode(array("error" => false,"HTML" => $this->load->view("loads/nominadoModal",$data,TRUE),"msg" => ''));die();

	
	}
}