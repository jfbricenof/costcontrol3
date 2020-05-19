<?php
if (!defined('BASEPATH')) {exit('No direct script access allowed');}
class Empresa_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    //creamos la funcion nuevo comentario que será la que haga la inserción a la base
    //de datos pasándole los datos a introducir en forma de array, siempre al estilo ci
    function ingresar_empresa($id_cuenta,$nit,$nombre,$direccion,$ciudad,$telfijo,$celular,$correo){
        $data = array(
                'id_cuenta' => $id_cuenta,
                'nit' => $nit,
                'nombre' => $nombre,
                'direccion' => $direccion,
                'ciudad' => $ciudad,
                'tel_fijo' => $telfijo,
                'tel_celular' => $celular,
                'correo' => $correo,
                'id_user' => 1,
                );
        if ($this->db->insert('empresa',$data)) {
            return true;
        } else {
            return false;
        }     
    }

    //listar empresas por el id de cuenta
    function listar_empresas($idcuenta){
        $this->db->select('id_empresa,nit,nombre,direccion,ciudad,tel_fijo,tel_celular,correo');
        $this->db->where('id_cuenta', $idcuenta);
        $query=$this->db->get('empresa');
        return $query->result();   
    }
}
/* End of file  */
