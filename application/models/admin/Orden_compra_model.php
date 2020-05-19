<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orden_compra_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos las ordenes
    function get_info_ordenes(){
        $this->db->select('OC.id_OrdenCompra,OC.fecha,OC.id_provee,OC.requisicion,OC.total,Pr.razon,Pr.nit');
        $this->db->from('OrdenCompra AS OC');
        $this->db->join('Proveedores AS Pr', 'OC.id_provee = Pr.id_provee');
        $query=$this->db->get();
        return $query->result();
    }

    function get_info_ordenes_pendientes(){
        $this->db->select('OC.id_OrdenCompra,OC.fecha,OC.id_provee,OC.requisicion,OC.total,Pr.razon,Pr.nit');
        $this->db->from('OrdenCompra AS OC');
        $this->db->join('Proveedores AS Pr', 'OC.id_provee = Pr.id_provee');
        $this->db->where('OC.estado', 'Pendiente');
        $query=$this->db->get();
        return $query->result();
    }

    function get_encabezado(){
        $this->db->select('*');
        $query=$this->db->get('Empresa');
        return $query->result();
    }

    function get_info_orden($id){
        $this->db->select('OC.id_OrdenCompra,OC.fecha,OC.id_provee,OC.requisicion,OC.cond_pago,OC.observacion,OC.subtotal,OC.fecha_entrega,,OC.fecha_requi,OC.id_recibe,OC.total,Pr.razon,,Pr.nit,Em.nombre,Em.apellido');
        $this->db->from('OrdenCompra AS OC');
        $this->db->join('Proveedores AS Pr', 'OC.id_provee = Pr.id_provee');
        $this->db->join('Empleado AS Em', 'OC.id_recibe = Em.id_empleado');/*
        $this->db->join('Iva AS Iv', 'OC.id_iva = Iv.id_iva');*/
        $this->db->where('OC.id_OrdenCompra', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function get_detalle_orden($id){
        $this->db->select('DO.id_DetalleOrden,DO.id_material,DO.cant_material,DO.precio_unit,DO.subtotal,Ma.nombre,Ma.unidad');
        $this->db->from('DetalleOrden AS DO');
        $this->db->join('Material AS Ma', 'DO.id_material = Ma.id_material');
        $this->db->where('DO.id_OrdenCompra', $id);
        $query=$this->db->get();
        return $query->result();
    }

    function get_detalle_orden_pendiente($id){
        $this->db->select('DO.id_DetalleOrden,DO.id_material,DO.cant_material,DO.precio_unit,DO.subtotal,Ma.nombre,Ma.unidad');
        $this->db->from('DetalleOrden AS DO');
        $this->db->join('Material AS Ma', 'DO.id_material = Ma.id_material');
        $this->db->where('DO.id_OrdenCompra', $id);
         $this->db->where('DO.estado', 'Pendiente');
        $query=$this->db->get();
        return $query->result();
    }

    function ingresar_orden($data){
        if ($this->db->insert('OrdenCompra',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function ingresar_detalle_orden($data){
        if ($this->db->insert('DetalleOrden',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
	}

    function update_estado($id){
        $updateData = array(
           'estado'=>'Finalizada'
        );
        $this->db->where('id_OrdenCompra', $id);
        if ($this->db->update('OrdenCompra',$updateData)) {
            return true;
        } else {
            return false;
        }
    }

    function update_estado_detalle($id){
        $updateData = array(
           'estado'=>'Finalizada'
        );
        $this->db->where('id_DetalleOrden', $id);
        if ($this->db->update('DetalleOrden',$updateData)) {
            return true;
        } else {
            return false;
        }
    }
}
