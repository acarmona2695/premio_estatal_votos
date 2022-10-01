<?php
class RegistroModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function listAsociacion(){
        try{
			$this->db->select("pk_asociacion,descripcion");
			$this->db->from("cat_asociacion");
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }

	public function listModalidad(){
        try{
			$this->db->select("pk_modalidad,descripcion");
			$this->db->from("cat_modalidad");
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }
    
}