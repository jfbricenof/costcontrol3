<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devolucion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todas las devoluciones
    function get_info_devoluciones(){
        $this->db->select('DEV.id_devolucion,DEV.fecha,DEV.id_provee,DEV.total,Pr.razon');
        $this->db->from('Devolucion AS DEV');
        $this->db->join('Proveedores AS Pr', 'DEV.id_provee = Pr.id_provee');
        $query=$this->db->get();
        return $query->result();
    }

    function get_info_devolucion($id){
        $this->db->select('DEV.id_devolucion,DEV.fecha,DEV.id_provee,DEV.observacion,DEV.subtotal,DEV.total,Pr.razon');
        $this->db->from('Devolucion AS DEV');
        $this->db->join('Proveedores AS Pr', 'DEV.id_provee = Pr.id_provee');
        $this->db->where('DEV.id_devolucion', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function get_detalle_devolucion($id){
        $this->db->select('DD.id_DetalleDevolucion,DD.id_material,DD.cant_material,DD.id_actividad,DD.precio_unit,DD.subtotal,Ma.nombre,Ma.unidad,Ac.nombre');
        $this->db->from('DetalleDevolucion AS DD');
        $this->db->join('Material AS Ma', 'DD.id_material = Ma.id_material');
        $this->db->join('Actividad AS Ac', 'DD.id_actividad = Ac.id_actividad');
        $this->db->where('DD.id_devolucion', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function ingresar_devolucion($data){
        if ($this->db->insert('Devolucion',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function ingresar_detalle_devolucion($data){
        if ($this->db->insert('DetalleDevolucion',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
	}
}
