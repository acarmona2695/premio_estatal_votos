<?php
class InicioModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function inicioModelo($filtros){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->db->select("v.pk_voto,
		                   n.nombre_nominado AS nominado,

						   
						 
						   ");

		$this->db->from("voto AS v");
		$this->db->join("nominado AS n", "n.pk_nominado = v.fk_nominado");
        if(isset($filtros['s*x'])){
            $this->db->order_by($filtros['sidx'] ,$filtros['sord']);
        }else{
            $this->db->order_by('pk_voto','ASC');
        }
        if($filtros['tipo'] == 'PARCIAL'){
            $this->db->limit($filtros['limit'],$filtros['start']);
        }
        $query = $this->db->get();
        $tmp = $query->num_rows();
        $rt = ($tmp > 0) ? $query->result_array() : array();
        if($filtros['tipo'] == 'TOTAL'){
            return $tmp;
        }else if($filtros['tipo'] == 'PARCIAL'){
            return $rt;
        }
    }

}
