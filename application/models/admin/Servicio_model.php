<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos los servicios
    function get_info_servicios(){
        $this->db->select('*');
        $query=$this->db->get('Servicio');
        return $query->result();
    }

    function ingresar_servicio($data){
        if ($this->db->insert('Servicio',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function delete_servicio($id_servicio){
        $this->db->where('id_servicio', $id_servicio);
        if ($this->db->delete('Servicio')) {
            return true;
        } else {
            return false;
        }
    }

    function update_servicio($id_servicio,$data){
        $this->db->where('id_servicio', $id_servicio);
        if ($this->db->update('Servicio',$data)) {
            return true;
        } else {
            return false;
        }
    }
}