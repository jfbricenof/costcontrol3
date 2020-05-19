<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_general_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }
    // consultar todos los tipos de inmuebles
    function get_info_empresa(){
        $this->db->select('*');
        $query=$this->db->get('Empresa');
        return $query->result();
    }

    function update_empresa($data){
        if ($this->db->update('Empresa',$data)) {
            return true;
        } else {
            return false;
        }
    }

    function get_info_ivas(){
        $this->db->select('*');
        $query=$this->db->get('Iva');
        return $query->result();
    }

    function ingresar_iva($data){
        if ($this->db->insert('Iva',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function delete_iva($id_iva){
        $this->db->where('id_iva', $id_iva);
        if ($this->db->delete('Iva')) {
            return true;
        } else {
            return false;
        }
    }

    function update_iva($id_iva,$data){
        $this->db->where('id_iva', $id_iva);
        if ($this->db->update('Iva',$data)) {
            return true;
        } else {
            return false;
        }
    }
}