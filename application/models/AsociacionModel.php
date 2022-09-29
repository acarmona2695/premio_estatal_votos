<?php
class AsociacionModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function asociacionModelo($filtros){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->db->select("pk_asociacion,nombre_asociacion");
        $this->db->from("cat_asociacion");
        if(isset($filtros['sidx'])){
            $this->db->order_by($filtros['sidx'] ,$filtros['sord']);
        }else{
            $this->db->order_by('pk_asociacion','ASC');
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
    public function asociacionGuardar($datos){
        $res = array("error" => false,"msg" => '');
        try {
            $this->db->trans_begin();
            if($datos['pk_asociacion'] == 0){
                $this->db->insert('cat_asociacion',$datos);
            }else{
                $this->db->where("pk_asociacion",$datos['pk_asociacion']);
                $this->db->update('cat_asociacion',$datos);
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
    public function obtenerRegistroPorId($id){
        $this->db->select("pk_asociacion, nombre_asociacion");
        $this->db->from("cat_asociacion");
        $this->db->where("pk_asociacion",$id);
        $query = $this->db->get();
        return $query->row_array();
    }
}