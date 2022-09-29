<?php
class AtletaModel extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function atletaModelo($filtros){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $this->db->select("a.pk_atleta,
                           a.nombre_atleta,
                           asoci.nombre_asociacion AS fk_asociacion,
                           d.nombre_disciplina AS fk_disciplina ");

        $this->db->from("atleta AS a");
    
        $this->db->join("cat_asociacion AS asoci", "asoci.pk_asociacion = a.fk_asociacion");
        $this->db->join("cat_disciplina AS d", "d.pk_disciplina = a.fk_disciplina");

        if(isset($filtros['sidx'])){
            $this->db->order_by($filtros['sidx'] ,$filtros['sord']);
        }else{
            $this->db->order_by('pk_atleta','ASC');
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
    public function atletaGuardar($datos){
        $res = array("error" => false,"msg" => '');
        try {
            $this->db->trans_begin();
            if($datos['pk_atleta'] == 0){
                $this->db->insert('atleta',$datos);
            }else{
                $this->db->where("pk_atleta",$datos['pk_atleta']);
                $this->db->update('atleta',$datos);
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
        $this->db->select("a.pk_atleta,
                           a.nombre_atleta,
                           a.fk_asociacion,
                           a.fk_disciplina");

        
        
        $this->db->from("atleta AS a");
        $this->db->where("a.pk_atleta",$id);
        $query = $this->db->get();
        return $query->row_array();
    }
}