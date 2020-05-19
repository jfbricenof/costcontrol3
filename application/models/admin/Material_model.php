<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos los empleados
    function get_info_materiales(){
        $this->db->select('*');
        $query=$this->db->get('Material');
        return $query->result();
    }

    function ingresar_material($data){
        if ($this->db->insert('Material',$data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return false;
        }
    }

    function delete_material($id_material){
        $this->db->where('id_material', $id_material);
        if ($this->db->delete('Material')) {
            return true;
        } else {
            return false;
        }
    }

    function update_material($id_material,$data){
        $this->db->where('id_material', $id_material);
        if ($this->db->update('Material',$data)) {
            return true;
        } else {
            return false;
        }
    }


    function reporte_info_materiales(){
        $this->db->select('M.nombre,Sum(DE.cant_material) AS cant,Sum(DE.subtotal) AS gastado,Sum(DE.subtotal) AS gastado,A.nombre AS Actividad,DO.id_material,DE.id_actividad');
        $this->db->from('DetalleEntrada AS DE');
        $this->db->join('DetalleOrden AS DO', 'DE.id_DetalleOrden = DO.id_DetalleOrden');
        $this->db->join('Actividad AS A', 'DE.id_actividad = A.id_actividad');
        $this->db->join('Material AS M', 'DO.id_material = M.id_material');
        $this->db->group_by('DO.id_material, DE.id_actividad'); 
        $query=$this->db->get();
        return $query->result();
    }
}