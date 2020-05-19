<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_provee_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos los empleados
    function get_info_proves(){
        $this->db->select('*');
        $query=$this->db->get('Proveedores');
        return $query->result();
    }

    function ingresar_provee($data){
        if ($this->db->insert('Proveedores',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function delete_provee($id_provee){
        $this->db->where('id_provee', $id_provee);
        if ($this->db->delete('Proveedores')) {
            return true;
        } else {
            return false;
        }
    }

    function update_provee($id_provee,$data){
        $this->db->where('id_provee', $id_provee);
        if ($this->db->update('Proveedores',$data)) {
            return true;
        } else {
            return false;
        }
    }
}