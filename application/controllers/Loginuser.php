<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginUser extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user/ingresar_model');
	}

	public function index(){
		if ($this->session->userdata('login')) {
			redirect(base_url().'user/admin');
		}else{
			$this->load->view('user/ingresar');
		}
	}

	public function validar(){

		$this->form_validation->set_rules('dni','Cedula','required|numeric');
		$this->form_validation->set_rules('password','Contraseña','required');

		if ($this->form_validation->run() === FALSE){
			$this->load->view('user/ingresar');
		}else{
			$usu = $this->input->post('dni');
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
			redirect(base_url()."loginuser");
		} else {
			if (!password_verify($contra, $res->contrase)) {
				$this->session->set_flashdata("error", "La contraseña no es valida. Por favor intente nuevamente");
				redirect(base_url()."loginuser");
			}else{
				$data = array (
					'id_persona' => $res->id_persona,
					'dni_persona' => $res->dni_persona,
					'nombres' => $res->nombres,
					'apellidos' => $res->apellidos,
					'correo' => $res->correo,
					'contrase' => $res->contrase,
					'login' => TRUE
				);
				$this->session->set_userdata($data);
				redirect(base_url().'user/inmuebles');
			}
		}
	}

	public function logout(){
		$data = array (
				'id_persona' => '',
				'dni_persona' => '',
				'nombres' => '',
				'apellidos' => '',
				'correo' => '',
				'contrase' => '',
				'login' => FALSE
			);
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
		redirect(base_url()."loginuser");
	}
}
