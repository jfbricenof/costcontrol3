<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InfoActividades extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/actividad_model');
    }

	public function index(){
		$info_actividades = $this->actividad_model->get_info_actividades();
		$data['actividades'] = $info_actividades;
		$this->mytemplate->loadAdmin('admin/infoactividades', $data);
	}





}