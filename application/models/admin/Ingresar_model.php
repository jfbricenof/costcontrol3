<?php
if (!defined('BASEPATH')) {exit('No direct script access allowed');}
class Ingresar_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    function validar_ingreso($usu){
        $this->db->select('*');
        $this->db->where('email', $usu);
        //$this->db->where('estado', 1);
        $this->db->limit('1');
        $query=$this->db->get('Usuario');
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
            return false;
        }
    }
}
/* End of file  */
