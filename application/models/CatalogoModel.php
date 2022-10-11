<?php
class CatalogoModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function listEstatus(){
        try{
			$this->db->select("pk_estatus,descripcion");
			$this->db->from("cat_estatus");
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }
    public function listPerfiles(){
        try{
			$this->db->select("pk_perfil,descripcion");
			$this->db->from("cat_perfil");
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }

    public function listDeportista(){
        try{
			$this->db->select("pk_nominado,nombre_nominado");
			$this->db->from("nominado");
			$this->db->where('fk_modalidad = 1');
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }

    public function listEntrenador(){
        try{
			$this->db->select("pk_nominado,nombre_nominado");
			$this->db->from("nominado");
			$this->db->where('fk_modalidad = 2');
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }

    public function listFomento(){
        try{
			$this->db->select("pk_nominado,nombre_nominado");
			$this->db->from("nominado");
			$this->db->where('fk_modalidad = 3');
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }
}