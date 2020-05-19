<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_provee extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/config_provee_model');
    }

	public function index(){
		$info_proves = $this->config_provee_model->get_info_proves();
		$data['proves'] = $info_proves;
		$this->mytemplate->loadAdmin('admin/config_provee', $data);
	}

	public function add_provee(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('provee_razon','Razón Social','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_nit','NIT','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_ncomercial','Nombre Comercial','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_correo','Correo Electrónico','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_direccion','Dirección','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_ciudad','Ciudad','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_tel','Teléfonos','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_cel','Celular','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_contacto','Contacto','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{

				$db_data = array(
					'razon' => $this->security->xss_clean($this->input->post('provee_razon')),
					'nit' => $this->security->xss_clean($this->input->post('provee_nit')),
					'ncomercial' => $this->security->xss_clean($this->input->post('provee_ncomercial')),
					'correo' => $this->security->xss_clean($this->input->post('provee_correo')),
					'direccion' => $this->security->xss_clean($this->input->post('provee_direccion')),
					'ciudad' => $this->security->xss_clean($this->input->post('provee_ciudad')),
					'tel' => $this->security->xss_clean($this->input->post('provee_tel')),
					'cel' => $this->security->xss_clean($this->input->post('provee_cel')),
					'contacto' => $this->security->xss_clean($this->input->post('provee_contacto'))
				);

				$nuevo_provee = $this->config_provee_model->ingresar_provee($db_data);
				if ($nuevo_provee) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function borrar_provee($id_provee){
		$del_provee = $this->config_provee_model->delete_provee($id_provee);
		if($del_provee){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_provee(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('provee_razon_edit','Razón Social','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_nit_edit','NIT','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_ncomercial_edit','Nombre Comercial','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_correo_edit','Correo Electrónico','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_direccion_edit','Dirección','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_ciudad_edit','Ciudad','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_tel_edit','Teléfonos','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_cel_edit','Celular','trim|required|max_length[40]');
			$this->form_validation->set_rules('provee_contacto_edit','Contacto','trim|required|max_length[40]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$id_provee = $this->security->xss_clean($this->input->post('id_provee'));
				$db_data = array(
					'razon' => $this->security->xss_clean($this->input->post('provee_razon_edit')),
					'nit' => $this->security->xss_clean($this->input->post('provee_nit_edit')),
					'ncomercial' => $this->security->xss_clean($this->input->post('provee_ncomercial_edit')),
					'correo' => $this->security->xss_clean($this->input->post('provee_correo_edit')),
					'direccion' => $this->security->xss_clean($this->input->post('provee_direccion_edit')),
					'ciudad' => $this->security->xss_clean($this->input->post('provee_ciudad_edit')),
					'tel' => $this->security->xss_clean($this->input->post('provee_tel_edit')),
					'cel' => $this->security->xss_clean($this->input->post('provee_cel_edit')),
					'contacto' => $this->security->xss_clean($this->input->post('provee_contacto_edit'))
				);

				$update_provee = $this->config_provee_model->update_provee($id_provee,$db_data);

				if($update_provee){
					$data = array("res"=>"success");
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{

		}
	}
}
