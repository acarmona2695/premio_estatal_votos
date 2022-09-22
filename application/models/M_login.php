<?php
class M_login extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
    public function now(){
		return $this->db->query("SELECT DATE_FORMAT(NOW(),'%Y-%m-%d') AS f")->row()->f;
	}
	public function contrasenaGuardar($datos){
		$res = array("error" => false,"msg" => '');
        try {
            $this->db->trans_begin();
			$this->db->select("pk_usuario");
			$this->db->from('usuario');
			$this->db->where('pk_usuario',$datos['pk_usuario']);
			$query = $this->db->get();
			if($query->result_array() > 1){
				$contrasena_nueva = sha1(trim($datos['contrasena_usuario']));
				$this->db->query("UPDATE usuario SET fecha_modificacion = NOW(),contrasena_usuario = ?
				WHERE pk_usuario = ?",array($contrasena_nueva,$datos['pk_usuario']));
			}else{
				$res['error'] = true;
				$res['msg'] = 'La contraseña actual es incorrecta';
				return $res;
			}
            $this->db->trans_commit();
            $res['msg'] = 'Contraseña cambiada correctamente';
            return $res;
        }catch (\Exception $e) {
            $this->db->trans_rollback();
            $res['error'] = true;
            $res['msg'] = 'Intente de nuevo, más tarde';
            return $res;
        }
	}
    public function checkLogIn($usuario,$password){
		$r = array();
		$this->db->select("u.pk_usuario,
							u.fk_perfil,
							u.fk_estatus,
							s.descripcion AS perfil_usuario,
							u.nombre_usuario,
							u.nombre,
							CASE
								WHEN u.fechaUltimoAcceso <> NULL AND u.fechaUltimoAcceso IS NOT NULL THEN
									u.fechaUltimoAcceso
								ELSE
									'N/D'
							END AS fechaUltimoAcceso");
		$this->db->from('usuario AS u');
		$this->db->join('cat_perfil AS s','u.fk_perfil = s.pk_perfil');
		if(!empty(trim($usuario))){
			$this->db->where('u.nombre_usuario',trim($usuario));
		}
		if(!empty(trim($password))){
			$this->db->where('u.contrasena_usuario',sha1(trim($password)));
		}
		$this->db->where('u.fk_estatus = 1');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$r = $query->result_array();
			$this->updateFechaInicio($r[0]['pk_usuario']);
		}
		return $r;
	}
	public function updateFechaInicio($idUsuario){
      	if(empty($idUsuario)){
			return false;
		}
      	$this->db->query("UPDATE usuario SET fechaUltimoAcceso = NOW() WHERE pk_usuario = ?",array($idUsuario));
    }
}