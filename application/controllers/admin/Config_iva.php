<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_iva extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/config_general_model');
    }

	public function index(){
		$info_ivas = $this->config_general_model->get_info_ivas();
		$data['ivas'] = $info_ivas;
		$this->mytemplate->loadAdmin('admin/config_iva', $data);
	}

	public function add_iva(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('iva_nombre','Nombre IVA','trim|required|max_length[40]');
			$this->form_validation->set_rules('iva_porcentaje','Porcentaje','trim|required|max_length[3]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{

				$db_data = array(
					'nombre_iva' => $this->security->xss_clean($this->input->post('iva_nombre')),
					'porcentaje_iva' => $this->security->xss_clean($this->input->post('iva_porcentaje'))
				);

				$nuevo_iva = $this->config_general_model->ingresar_iva($db_data);
				if ($nuevo_iva) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function borrar_iva($id_iva){
		$del_iva = $this->config_general_model->delete_iva($id_iva);
		if($del_iva){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_iva(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('iva_nombre_edit','Nombre IVA','trim|required|max_length[40]');
			$this->form_validation->set_rules('iva_porcentaje_edit','Porcentaje','trim|required|max_length[3]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$id_iva = $this->security->xss_clean($this->input->post('id_iva'));
				$db_data = array(
					'nombre_iva' => $this->security->xss_clean($this->input->post('iva_nombre_edit')),
					'porcentaje_iva' => $this->security->xss_clean($this->input->post('iva_porcentaje_edit'))
				);

				$update_iva = $this->config_general_model->update_iva($id_iva,$db_data);

				if($update_iva){
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
