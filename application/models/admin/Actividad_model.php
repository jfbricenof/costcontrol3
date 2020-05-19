<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos las actividades
    function get_info_actividades(){
        $this->db->select('*');
        $query=$this->db->get('Actividad');
        return $query->result();
    }

    function ingresar_actividad($data){
        if ($this->db->insert('Actividad',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function delete_actividad($id_actividad){
        $this->db->where('id_actividad', $id_actividad);
        if ($this->db->delete('Actividad')) {
            return true;
        } else {
            return false;
        }
    }

    function update_actividad($id_actividad,$data){
        $this->db->where('id_actividad', $id_actividad);
        if ($this->db->update('Actividad',$data)) {
            return true;
        } else {
            return false;
        }
    }
}