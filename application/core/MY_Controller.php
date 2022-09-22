<?php
class MY_Controller extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("America/Mexico_City");
        $this->load->helper('url');
	}
    public function MY_Controller(){
        date_default_timezone_set("America/Mexico_City");
        $this->load->helper('url');
    }
    public function funcionesBasicas($tituloSeccion){
    	if(!$this->session->userdata('pb_LogIn')){
			redirect(base_url());
		}
		$datos = array();
		$datos['SECCIONACTUAL'] = $tituloSeccion;
		$datos['tok'] = $this->security->get_csrf_hash();
		$datos['tok_name'] = $this->security->get_csrf_token_name();
		$datos['ramdon'] = time();
		$datos['idPerfil'] = $this->session->userdata('pb_idPerfil');
		return $datos;
	}
}