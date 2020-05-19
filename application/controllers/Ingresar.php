<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingresar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin/ingresar_model');
	}

	public function index(){
		if ($this->session->userdata('login')) {
			redirect(base_url().'admin/admin');
		}else{
			$this->load->view('admin/ingresar');
		}
	}

	public function validar(){
		//$this->output->enable_profiler(TRUE);

		$this->form_validation->set_rules('email','Correo Electrónico','required|valid_email');
		$this->form_validation->set_rules('password','Contraseña','required');

		if ($this->form_validation->run() === FALSE){
			$this->load->view('admin/ingresar');
		}else{
			$usu = $this->input->post('email');
			$contra = $this->input->post('password');
			$usu = $this->security->xss_clean($usu);
			$contra = $this->security->xss_clean($contra);

			$this->login($usu,$contra);
		}
	}

	public function login($usu,$contra){
		//$this->output->enable_profiler(TRUE);
		$res = $this->ingresar_model->validar_ingreso($usu);
		if (!$res) {
			$this->session->set_flashdata("error", "El usuario no existe. Por favor intente nuevamente");
			redirect(base_url());
		} else {
			if (!password_verify($contra, $res->pw)) {
				$this->session->set_flashdata("error", "La contraseña no es valida. Por favor intente nuevamente");
				redirect(base_url());
			}else{
				$data = array (
					'id_user' => $res->id_usuario,
					'id_empleado' => $res->id_empleado,
					'correo' => $res->email,
					'rol' => $res->tipo,
					'login' => TRUE
				);
				$this->session->set_userdata($data);
				redirect(base_url().'admin/kardex');
			}
		}
	}

	public function logout(){
		$data = array (
				'id_cuenta' => '',
				'nombres' => '',
				'apellidos' => '',
				'correo' => '',
				'rol' => '',
				'login' => FALSE
			);
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
