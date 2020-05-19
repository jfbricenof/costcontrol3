<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_empleado_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos los empleados
    function get_info_empleados(){
        $this->db->select('*');
        $query=$this->db->get('Empleado');
        return $query->result();
    }

    function ingresar_empleado($data){
        if ($this->db->insert('Empleado',$data)) {
            return true;
        } else {
            return false;
        }
    }

    function delete_empleado($id_empleado){
        $this->db->where('id_empleado', $id_empleado);
        if ($this->db->delete('Empleado')) {
            return true;
        } else {
            return false;
        }
    }

    function update_empleado($id_empleado,$data){
        $this->db->where('id_empleado', $id_empleado);
        if ($this->db->update('Empleado',$data)) {
            return true;
        } else {
            return false;
        }
    }
}