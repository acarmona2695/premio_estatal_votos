<?php
class NominadoModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function nominadoModelo($filtros){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        if(isset($filtros['LIKE'])){
            if(isset($filtros['LIKE']['nombre']) && $filtros['LIKE']['nombre'] != "undefined" && trim($filtros['LIKE']['nombre']) != ""){
                $this->db->like("n.nombre_nominado",trim($filtros['LIKE']['nombre']),'BOTH');
            }
        }
        if(isset($filtros['WHERE'])){
            if(isset($filtros['WHERE']['asociacion']) && $filtros['WHERE']['asociacion'] != "undefined" && trim($filtros['WHERE']['asociacion']) != ""){
                $this->db->where("n.fk_asociacion",trim($filtros['WHERE']['asociacion']));
            }
            if(isset($filtros['WHERE']['modalidad']) && $filtros['WHERE']['modalidad'] != "undefined" && trim($filtros['WHERE']['modalidad']) != ""){
                $this->db->where("n.fk_modalidad",trim($filtros['WHERE']['modalidad']));
            }
        }
        $this->db->select("n.pk_nominado,
                            n.nombre_nominado,
                            u.nombre_usuario,
                            asoc.descripcion AS asociacion,
                            m.descripcion AS modalidad,
                            DATE_FORMAT(n.fecha_creacion,'%d/%m%/%Y') AS fecha_creacion,
                            DATE_FORMAT(n.fecha_modificacion,'%d/%m%/%Y %H:%i:%s') AS fecha_modificacion,CASE
                                WHEN n.estatus = 0 THEN
                                    'Inactivo'
                                ELSE
                                    'Activo'
                            END AS estatus
                            ");
        $this->db->from("nominado AS n");
        $this->db->join("cat_asociacion AS asoc", "asoc.pk_asociacion = n.fk_asociacion");
        $this->db->join("cat_modalidad AS m", "m.pk_modalidad = n.fk_modalidad");
        $this->db->join("usuario AS u", "u.pk_usuario = n.fk_usuario");

        if(isset($filtros['sidx'])){
            $this->db->order_by($filtros['sidx'] ,$filtros['sord']);
        }else{
            $this->db->order_by('pk_nominado','ASC');
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

    public function nominadoGuardar($datos){
        $res = array("error" => false,"msg" => '');
        try {
            $this->db->trans_begin();
            if($datos['pk_nominado'] == 0){
                $datos['fecha_creacion'] = $this->db->query("SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') AS f")->row()->f;;
                $datos['fk_usuario'] = $this->session->userdata('pb_idUsuario');
                $this->db->insert('nominado',$datos);
            }else{
                //$datos['fecha_modificacion'] = $this->db->query("SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') AS f")->row()->f;;
                $this->db->where("pk_nominado",$datos['pk_nominado']);
                $this->db->update('nominado',$datos);
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
        $this->db->select("n.pk_nominado,
                            n.nombre_nominado,
                            n.fk_asociacion,
                            n.fk_modalidad,
                            n.estatus");
        $this->db->from("nominado AS n");
        $this->db->where("n.pk_nominado",$id);
        $query = $this->db->get();
        return $query->row_array();
    }
}