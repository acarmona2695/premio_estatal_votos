<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class InicioController extends My_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('InicioModel');
		
		$this->load->model('ClasificacionModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'inicio');
		}
		$datos = $this->funcionesBasicas('Inicio');
		$datos['menu'] = "inicio";
		$datos['NOMINADOS'] = $this->ClasificacionModel->listNominados();
		$this->load->view('inicio',$datos);
	}

	public function loadFormulario(){
		
		$data['pk_voto'] = $this->input->post('pk_voto');
		$data['INFO']['fk_nominado'] = '';
		

		$data['NOMINADOS'] = $this->ClasificacionModel->listNominados();
		echo json_encode(array("error" => false,"HTML" => $this->load->view("loads/inicioModal",$data,TRUE),"msg" => ''));die();
	}

	//................................................................................................................//
	// public function listNominadosForModalidadForUser(){

	// 	$data['modalidad'] = $this->input->post('modalidad');
	// 	$data['usuario'] = $this->input->post('usuario');
	// 	$data['nominados'] = $this->ClasificacionModel->listNominadosForModalidadForUser($this->input->post('modalidad'), $this->input->post('usuario') );
	// 	header('Content-Type: application/json');
    // 	echo json_encode($data);
	// }
//..........................................................................................................................//
}