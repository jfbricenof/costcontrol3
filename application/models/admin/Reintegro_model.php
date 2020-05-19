<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reintegro_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos las reintegro
    
    function get_info_reintegros(){
        $this->db->select('*');
        $this->db->from('Reintegro');
        $query=$this->db->get();
        return $query->result();
    }

    function get_info_reintegro($id){
        $this->db->select('*');
        $this->db->from('Reintegro');
        $this->db->where('id_reintegro', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function get_detalle_reintegro($id){
        $this->db->select('DR.id_reintegro,DR.id_material,DR.cant_material,Mat.nombre,Mat.unidad');
        $this->db->from('DetalleReintegro AS DR');
        $this->db->join('Material AS Mat', 'DR.id_material = Mat.id_material');
        $this->db->where('DR.id_reintegro', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function ingresar_reintegro($data){
        if ($this->db->insert('Reintegro',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function ingresar_detalle_reintegro($data){
        if ($this->db->insert('DetalleReintegro',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
	}
}
