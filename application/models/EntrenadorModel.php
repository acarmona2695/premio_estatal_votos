<?php
class EntrenadorModel extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function entrenadorModelo($filtros){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->db->select("e.pk_entrenador,
                           e.nombre_entrenador,
                           asoci.nombre_asociacion AS fk_asociacion,
                           d.nombre_disciplina AS fk_disciplina ");

        $this->db->from("entrenador AS e");
    
        $this->db->join("cat_asociacion AS asoci", "asoci.pk_asociacion = e.fk_asociacion");
        $this->db->join("cat_disciplina AS d", "d.pk_disciplina = e.fk_disciplina");

        if(isset($filtros['sidx'])){
            $this->db->order_by($filtros['sidx'] ,$filtros['sord']);
        }else{
            $this->db->order_by('pk_entrenador','ASC');
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
    public function entrenadorGuardar($datos){
        $res = array("error" => false,"msg" => '');
        try {
            $this->db->trans_begin();
            if($datos['pk_entrenador'] == 0){
                $this->db->insert('entrenador',$datos);
            }else{
                $this->db->where("pk_entrenador",$datos['pk_entrenador']);
                $this->db->update('entrenador',$datos);
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
        $this->db->select("e.pk_entrenador,
                           e.nombre_entrenador,
                           e.fk_asociacion,
                           e.fk_disciplina");

        
        
        $this->db->from("entrenador AS e");
        $this->db->where("e.pk_entrenador",$id);
        $query = $this->db->get();
        return $query->row_array();
    }
}