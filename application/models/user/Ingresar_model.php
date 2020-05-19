<?php
if (!defined('BASEPATH')) {exit('No direct script access allowed');}
class Ingresar_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function validar_ingreso($dni){
        $this->db->select('id_persona,dni_persona,nombres,apellidos,correo,contrase');
        $this->db->where('dni_persona', $dni);
        $this->db->limit('1');
        $query=$this->db->get('persona');
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }
}
/* End of file  */
