<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kardex_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // consultar todos las actividades
    function get_kardex($mat){
        $this->db->select('*');
        $this->db->where('id_material',$mat);
        $query=$this->db->get('kardex');
        return $query->result();
    }
}