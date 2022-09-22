<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class InicioController extends My_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('InicioModel');
	}
	public function index(){
		if($this->session->userdata('pb_idPerfil') != 1){
			redirect(base_url().'inicio');
		}
		$datos = $this->funcionesBasicas('Inicio');
		$datos['menu'] = "inicio";
		$this->load->view('inicio',$datos);
	}
}