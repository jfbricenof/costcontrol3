<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_materiales extends CI_Controller {
	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/material_model');
        $this->load->model('admin/kardex_model');
    }


	public function index(){
		$data['info_materiales'] = $this->material_model->reporte_info_materiales();
		$this->mytemplate->loadAdmin('admin/info_materiales',$data);
	}
}
