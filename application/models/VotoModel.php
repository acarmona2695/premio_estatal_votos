<?php
class VotoModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function votoModelo($filtros){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        // if(isset($filtros['LIKE'])){
        //     if(isset($filtros['LIKE']['nombre']) && $filtros['LIKE']['nombre'] != "undefined" && trim($filtros['LIKE']['nombre']) != ""){
        //         $this->db->like("n.nombre_nominado",trim($filtros['LIKE']['nombre']),'BOTH');
        //     }
        // }
        if(isset($filtros['WHERE'])){
            if(isset($filtros['WHERE']['modalidad']) && $filtros['WHERE']['modalidad'] != "undefined" && trim($filtros['WHERE']['modalidad']) != ""){
                $this->db->where("n.fk_modalidad",trim($filtros['WHERE']['modalidad']));
            }
        }
        $this->db->select("v.pk_voto,
                           u.nombre_usuario as usuario, 
                           n.nombre_nominado as nominado,
                           m.descripcion as modalidad,         
                           DATE_FORMAT(n.fecha_creacion,'%d/%m%/%Y') AS fecha_creacion,
                           v.punto
        
         ");
$this->db->from("voto AS v");
$this->db->join("nominado AS n", "n.pk_nominado = v.fk_nominado");
$this->db->join("cat_modalidad AS m", "m.pk_modalidad = v.fk_modalidad");
$this->db->join("usuario AS u", "u.pk_usuario = v.fk_usuario");



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
   
public function votoGuardar($datos){
    $res = array("error" => false,"msg" => '');
    try {
        $this->db->trans_begin();
        if($datos['pk_voto'] == 0){
            $datos['fecha_creacion'] = $this->db->query("SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') AS f")->row()->f;;
            $datos['fk_usuario'] = $this->session->userdata('pb_idUsuario');
            $this->db->insert('voto',$datos);
        }else{
           
            $this->db->where("pk_voto",$datos['pk_voto']);
            $this->db->update('voto',$datos);
        }
        $this->db->trans_commit();
        $res['msg'] = 'Registro guardado correctamente';
        return $res;
    }catch (\Exception $e) {
        $this->db->trans_rollback();
        $res['error'] = true;
        $res['msg'] = 'Intente de nuevo, más tarde';
        return $res;
    }
 }

}