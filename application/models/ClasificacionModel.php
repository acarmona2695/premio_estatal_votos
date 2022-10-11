<?php
class ClasificacionModel extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

    public function listNominados(){
        try{
			$this->db->select("pk_nominado,nombre_nominado");
			$this->db->from("nominado");
			$query = $this->db->get();
		    return ($query->num_rows() > 0) ? $query->result_array() : array();
		}catch(Exception $ex){
			return array();
		}
    }
}
//-----------------------------------------------------------------------------------------------------------------------------//
// 	public function listNominadosForModalidadForUser($modalidad, $usuario){

// 		$consultaMaster = 'SELECT nominado.pk_nominado, nominado.nombre_nominado, nominado.fk_asociacion, 
// 		voto.punto, voto.fk_usuario, usuario.nombre, usuario.apellido1, usuario.apellido2, cat_asociacion.descripcion as asociacion
// 		FROM nominado 
// 		LEFT JOIN voto ON voto.fk_nominado = nominado.pk_nominado AND voto.fk_usuario = ?
// 		LEFT JOIN usuario ON usuario.pk_usuario = voto.fk_usuario
// 		LEFT JOIN cat_asociacion ON cat_asociacion.pk_asociacion = nominado.fk_asociacion
// 		WHERE nominado.fk_modalidad = ?
// 		ORDER BY voto.punto DESC';

// 		$query = $this->db->query($consultaMaster, [$usuario, $modalidad]);
// 		return $query->result();
// 	}
// }
//-----------------------------------------------------------------------------------------------------------------------------//