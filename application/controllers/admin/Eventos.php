<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventos extends CI_Controller {
	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
    }
	public function index(){
		$this->mytemplate->loadAdmin('admin/eventos');
	}
}
