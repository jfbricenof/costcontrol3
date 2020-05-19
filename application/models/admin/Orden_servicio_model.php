<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orden_servicio_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos las ordenes
    function get_info_ordenes(){
        $this->db->select('OS.id_OrdenServicio,OS.fecha,OS.id_provee,OS.total,Pr.razon');
        $this->db->from('OrdenServicio AS OS');
        $this->db->join('Proveedores AS Pr', 'OS.id_provee = Pr.id_provee');
        $query=$this->db->get();
        return $query->result();
    }

    function get_info_orden($id){
        $this->db->select('OS.id_OrdenServicio,OS.fecha,OS.id_provee,OS.cond_pago,OS.observacion,OS.subtotal,OS.fecha_fin,OS.id_recibe,OS.total,Pr.razon,Em.nombre,Em.apellido');
        $this->db->from('OrdenServicio AS OS');
        $this->db->join('Proveedores AS Pr', 'OS.id_provee = Pr.id_provee');
        $this->db->join('Empleado AS Em', 'OS.id_recibe = Em.id_empleado');/*
        $this->db->join('Iva AS Iv', 'OS.id_iva = Iv.id_iva');*/
        $this->db->where('OS.id_OrdenServicio', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function get_detalle_orden($id){
        $this->db->select('DOS.id_DetalleOrdenServicio,DOS.id_servicio,DOS.cant_servicio,DOS.precio_unit,DOS.subtotal,Ser.nombre,Ser.unidad');
        $this->db->from('DetalleOrdenServicio AS DOS');
        $this->db->join('Servicio AS Ser', 'DOS.id_servicio = Ser.id_servicio');
        $this->db->where('DOS.id_OrdenServicio', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function ingresar_orden($data){
        if ($this->db->insert('OrdenServicio',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function ingresar_detalle_orden($data){
        if ($this->db->insert('DetalleOrdenServicio',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
	}
}
