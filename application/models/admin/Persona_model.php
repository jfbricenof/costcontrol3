<?php
if (!defined('BASEPATH')) {exit('No direct script access allowed');}
class Persona_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    //creamos la funcion nuevo comentario que será la que haga la inserción a la base
    //de datos pasándole los datos a introducir en forma de array, siempre al estilo ci
    function ingresar_persona($id,$id_empresa,$nombre,$apellidos,$correo,$telfijo,$celular,$tipo,$id_user){
        $data = array(
                'id_empresa' => $id_empresa,
                'nombres' => $nombre,
                'dni_persona' => $id,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'tel_fijo' => $telfijo,
                'tel_celular' => $celular,
                'tipo' => $tipo,
                'id_user' => $id_user,
                );
        if ($this->db->insert('persona',$data)) {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        } else {
            return false;
        }
    }

    //Obtener persona por ID
    function obtener_persona($id){
        $this->db->select('id_persona,dni_persona,nombres,apellidos,correo,tel_fijo,tel_celular,tipo');
        $this->db->where('id_persona', $id);
        $query=$this->db->get('persona');
        return $query->result();
    }

    function obtener_inmueble($id){
        $this->db->select('id_inmueble');
        $this->db->where('id_propietario', $id);
        $query=$this->db->get('inmueble');
        return $query->result();
    }

    function actualizar_persona($dni,$nombre,$apellidos,$correo,$telfijo,$celular,$id){
        $data = array(
                'nombres' => $nombre,
                'dni_persona' => $dni,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'tel_fijo' => $telfijo,
                'tel_celular' => $celular
                );
        $this->db->where('id_persona', $id);
        if ($this->db->update('persona', $data)) {
            return  true;
        } else {
            return false;
        }
    }

    function eliminar_persona($id){
        $this->db->where('id_persona',$id);
        if ($this->db->delete('persona')) {
            return true;
        } else {
            return false;
        }
    }
}
/* End of file  */
