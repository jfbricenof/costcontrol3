<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos los empleados
    function get_info_usuarios(){
        $this->db->select('*');
        $query=$this->db->get('Usuario');
        return $query->result();
    }

    function ingresar_usuario($data){
        if ($this->db->insert('Usuario',$data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_usuario($id_usuario){
        $this->db->where('id_usuario', $id_usuario);
        if ($this->db->delete('Usuario')) {
            return true;
        } else {
            return false;
        }
    }

    function update_usuario($id_usuario,$data){
        $this->db->where('id_usuario', $id_usuario);
        if ($this->db->update('Usuario',$data)) {
            return true;
        } else {
            return false;
        }
    }
}