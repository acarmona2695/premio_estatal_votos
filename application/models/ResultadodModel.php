<?php
class ResultadodModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function resultadodModelo($filtros){
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $this->db->select("v.pk_voto,
                           u.nombre_usuario as usuario, 
                           n.nombre_nominado as nominado,
                           m.descripcion as modalidad,         
                           DATE_FORMAT(n.fecha_creacion,'%d/%m%/%Y') AS fecha_creacion,
                           v.punto,
                           SUM(v.punto) as total
        
         ");
$this->db->from("voto AS v");
$this->db->join("nominado AS n", "n.pk_nominado = v.fk_nominado");
$this->db->join("cat_modalidad AS m", "m.pk_modalidad = v.fk_modalidad");
$this->db->join("usuario AS u", "u.pk_usuario = v.fk_usuario");
$this->db->where("v.fk_nominado = v.fk_nominado");


if(isset($filtros['sidx'])){
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