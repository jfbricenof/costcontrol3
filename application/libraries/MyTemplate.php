<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyTemplate extends CI_Controller{

	var $template_data = array();

	public function __construct(){
		$this->ci = & get_instance();
		$this->ci->load->model('admin/empresa_model');
	}

	public function set($name,$value){
		$this->template_data[$name]=$value;
		//$this->template_data['empresas']=$this->ci->empresa_model->listar_empresas($this->ci->session->userdata('id_cuenta'));
	}

	public function set2($name,$value){
		$this->template_data[$name]=$value;
	}

	public function loadAdmin($view_name='',$view_data=array(),$return = FALSE){
		$this->set('contents',$this->ci->load->view($view_name,$view_data,TRUE));
		$this->ci->load->view('admin/admin',$this->template_data,$return);
	}

	public function loadAdminUser($view_name='',$view_data=array(),$return = FALSE){
		$this->set2('contents',$this->ci->load->view($view_name,$view_data,TRUE));
		$this->ci->load->view('user/admin',$this->template_data,$return);
	}
}