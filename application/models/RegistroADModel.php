<?php
class RegistroADModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function listAsociacion(){
        try{
			$this->db->select("pk_asociacion,nombre_asociacion");
			$this->db->from("cat_asociacion");
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }

	public function listDisciplina(){
        try{
			$this->db->select("pk_disciplina,nombre_disciplina");
			$this->db->from("cat_disciplina");
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }
    
}