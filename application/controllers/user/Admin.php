<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
    }
	public function index(){
		$this->mytemplate->loadAdminUser('admin/panel');
	}

	public function cambiar_empresa(){
		$emp_id = $this->input->get('empid');
		$key = $this->searchForId($emp_id, $this->session->userdata('array_empresas'));
		$this->session->set_userdata('empresa', $this->session->userdata('array_empresas')[$key]);
		redirect(base_url());
	}

	public function searchForId($id, $array) {
	   foreach ($array as $key => $val) {
	       if ($val->id_empresa === $id) {
	           return $key;
	       }
	   }
	   return null;
	}
}
