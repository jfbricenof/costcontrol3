<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kardex extends CI_Controller {
	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/material_model');
        $this->load->model('admin/kardex_model');
    }


	public function index(){
		$data['materiales'] = $this->material_model->get_info_materiales();
		$this->mytemplate->loadAdmin('admin/kardex',$data);
	}

	public function kardex_material(){
		if ($this->input->is_ajax_request()) {
			$material = $this->security->xss_clean($this->input->post('id_material'));

			$get_kardex = $this->kardex_model->get_kardex($material);

			if($get_kardex){
				$data = array(
					'res'=>'success',
		            'datos'=> $get_kardex
		        );
			}else{
				$data = array("res"=>"error3");
			}
			echo json_encode($data);
		}
	}
}
