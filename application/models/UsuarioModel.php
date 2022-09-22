<?php
class UsuarioModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function usuarioModelo($filtros){
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        if(isset($filtros['LIKE'])){
            if(isset($filtros['LIKE']['usuario']) && $filtros['LIKE']['usuario'] != "undefined" && trim($filtros['LIKE']['usuario']) != ""){
                $this->db->like("u.nombre_usuario",trim($filtros['LIKE']['usuario']),'BOTH');
            }
            if(isset($filtros['LIKE']['nombre']) && $filtros['LIKE']['nombre'] != "undefined" && trim($filtros['LIKE']['nombre']) != ""){
                $this->db->like("u.nombre",trim($filtros['LIKE']['nombre']),'BOTH');
            }
        }
        if(isset($filtros['WHERE'])){
            if(isset($filtros['WHERE']['perfil']) && $filtros['WHERE']['perfil'] != "undefined" && trim($filtros['WHERE']['perfil']) != ""){
                $this->db->where("u.fk_perfil",trim($filtros['WHERE']['perfil']));
            }
            if(isset($filtros['WHERE']['perfil']) && $filtros['WHERE']['fecha'] != "undefined" && trim($filtros['WHERE']['fecha']) != "" && strlen(trim($filtros['WHERE']['fecha'])) == "10"){
                $this->db->where("u.fecha_creacion",trim($filtros['WHERE']['fecha']));
            }
            if(isset($filtros['WHERE']['estatus']) && $filtros['WHERE']['estatus'] != "undefined" && trim($filtros['WHERE']['estatus']) != ""){
                $this->db->where("u.fk_estatus",trim($filtros['WHERE']['estatus']));
            }
        }
        $this->db->select("u.pk_usuario,
                            u.nombre_usuario,
                            u.nombre,
                            u.apellido1,
                            u.apellido2,
                            u.correo_usuario,
                            p.descripcion AS perfil_usuario,
                            DATE_FORMAT(u.fecha_creacion,'%d/%m%/%Y') AS fecha_creacion,
                            DATE_FORMAT(u.fecha_modificacion,'%d/%m%/%Y %H:%i:%s') AS fecha_modificacion,
                            DATE_FORMAT(u.fechaUltimoAcceso,'%d/%m%/%Y %H:%i:%s') AS fechaUltimoAcceso,
                            u.telefono_usuario,
                            e.descripcion AS estatus");
        $this->db->from("usuario AS u");
        $this->db->join("cat_estatus AS e", "e.pk_estatus = u.fk_estatus");
        $this->db->join("cat_perfil AS p", "p.pk_perfil = u.fk_perfil");
        if(isset($filtros['sidx'])){
            $this->db->order_by($filtros['sidx'] ,$filtros['sord']);
        }else{
            $this->db->order_by('u.pk_usuario','ASC');
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
    public function validarUsuarioExistente($usuario){
        $this->db->select("pk_usuario");
        $this->db->from("usuario");
        $this->db->where("nombre_usuario",$usuario);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function usuarioGuardar($datos){
        $res = array("error" => false,"msg" => '');
        try {
            $this->db->trans_begin();
            //echo json_encode($datos); die();
            /*if(isset($datos['contrasena_usuario']) && !empty(trim($datos['contrasena_usuario']))){
                $datos['contrasena_usuario'] = sha1(trim($datos['contrasena_usuario']));
            } */
            if($datos['pk_usuario'] == 0){
                $datos['fecha_creacion'] = $this->db->query("SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') AS f")->row()->f;;
                $this->db->insert('usuario',$datos);
            }else{
                //$datos['fecha_modificacion'] = $this->db->query("SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') AS f")->row()->f;;
                $this->db->where("pk_usuario",$datos['pk_usuario']);
                $this->db->update('usuario',$datos);
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
        $this->db->select("u.pk_usuario,
                            u.nombre_usuario,
                            u.nombre,
                            u.apellido1,
                            u.apellido2,
                            u.telefono_usuario,
                            u.correo_usuario,
                            u.fk_estatus,
                            u.fk_perfil");
        $this->db->from("usuario AS u");
        $this->db->where("u.pk_usuario",$id);
        $query = $this->db->get();
        return $query->row_array();
    }
}