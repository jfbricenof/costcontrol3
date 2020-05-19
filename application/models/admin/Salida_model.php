<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salida_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos las salidas
    
    function get_info_salidas(){
        $this->db->select('*');
        $this->db->from('Salida');
        $query=$this->db->get();
        return $query->result();
    }

    function get_info_salida($id){
        $this->db->select('*');
        $this->db->from('Salida');
        $this->db->where('id_salida', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function get_detalle_salida($id){
        $this->db->select('DS.id_salida,DS.id_material,DS.cant_material,Mat.nombre,Mat.unidad');
        $this->db->from('DetalleSalida AS DS');
        $this->db->join('Material AS Mat', 'DS.id_material = Mat.id_material');
        $this->db->where('DS.id_salida', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function ingresar_salida($data){
        if ($this->db->insert('Salida',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function ingresar_detalle_salida($data){
        if ($this->db->insert('DetalleSalida',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
	}
}
