<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccostos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos los centros
    function get_info_centros(){
        $this->db->select('*');
        $query=$this->db->get('Ccostos');
        return $query->result();
    }

    function ingresar_centro($data){
        if ($this->db->insert('Ccostos',$data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_centro($id_ccostos){
        $this->db->where('id_ccostos', $id_ccostos);
        if ($this->db->delete('Ccostos')) {
            return true;
        } else {
            return false;
        }
    }

    function editar_centro($id_ccostos,$data){
        $this->db->where('id_ccostos', $id_ccostos);
        if ($this->db->update('Ccostos',$data)) {
            return true;
        } else {
            return false;
        }
    }
}