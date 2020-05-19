<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_info_entradas(){
        $this->db->select('id_entrada,fecha,id_OrdenCompra,total,remision,factura');
        $this->db->from('Entrada');
        $query=$this->db->get();
        return $query->result();
    }

    function get_info_entrada($id){
        $this->db->select('E.id_entrada,E.fecha,E.id_OrdenCompra,E.subtotal,E.total,E.remision,E.factura,E.observacion,Oc.id_provee,Pr.razon,Pr.nit');
        $this->db->from('Entrada AS E');
        $this->db->join('OrdenCompra AS Oc', 'E.id_OrdenCompra = Oc.id_OrdenCompra');
        $this->db->join('Proveedores AS Pr', 'Oc.id_provee = Pr.id_provee');
        $this->db->where('E.id_entrada', $id);
        $query=$this->db->get();
        return $query->result();
    }
    function get_detalle_entrada($id){
        $this->db->select('DE.id_DetalleEntrada,DE.id_DetalleOrden,DE.cant_material,DE.precio_unit_DetalleOrden,DE.subtotal,DE.id_actividad,Do.id_material,Ma.nombre,Ma.unidad');
        $this->db->from('DetalleEntrada AS DE');
        $this->db->join('DetalleOrden AS Do', 'DE.id_DetalleOrden = Do.id_DetalleOrden');
        $this->db->join('Material AS Ma', 'Do.id_material = Ma.id_material');
        $this->db->where('DE.id_entrada', $id);
        $query=$this->db->get();
        return $query->result();
    }
       // consultar todos las ordenes
    function get_info_ordenes(){
        $this->db->select('OC.id_OrdenCompra,OC.fecha,OC.id_provee,OC.requisicion,OC.total,Pr.razon');
        $this->db->from('OrdenCompra AS OC');
        $this->db->join('Proveedores AS Pr', 'OC.id_provee = Pr.id_provee');
        $query=$this->db->get();
        return $query->result();
    }

    function get_info_orden($id){
        $this->db->select('OC.id_OrdenCompra,OC.fecha,OC.id_provee,OC.requisicion,OC.cond_pago,OC.observacion,OC.subtotal,OC.fecha_entrega,,OC.fecha_requi,OC.id_recibe,OC.total,Pr.razon,Em.nombre,Em.apellido');
        $this->db->from('OrdenCompra AS OC');
        $this->db->join('Proveedores AS Pr', 'OC.id_provee = Pr.id_provee');
        $this->db->join('Empleado AS Em', 'OC.id_recibe = Em.id_empleado');
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

    function ingresar_entrada($data){
        if ($this->db->insert('Entrada',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function ingresar_detalle_entrada($data){
        if ($this->db->insert('DetalleEntrada',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
	}
}
