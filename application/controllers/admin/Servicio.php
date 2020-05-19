<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/servicio_model');
    }

	
	public function add_servicio(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('servicio_nombre','Descripción','trim|required|max_length[40]');
			$this->form_validation->set_rules('servicio_unidad','Unidad','trim|required|max_length[4]');
			$this->form_validation->set_rules('servicio_tipo','Tipo','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{

				$db_data = array(
					'nombre' => $this->security->xss_clean($this->input->post('servicio_nombre')),
					'unidad' => $this->security->xss_clean($this->input->post('servicio_unidad')),
					'tipo' => $this->security->xss_clean($this->input->post('servicio_tipo'))
				);

				$nuevo_servicio = $this->servicio_model->ingresar_servicio($db_data);
				if ($nuevo_servicio) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function borrar_servicio($id_servicio){
		$del_servicio = $this->servicio_model->delete_servicio($id_servicio);
		if($del_servicio){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_servicio(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('servicio_nombre_edit','Descripción','trim|required|max_length[40]');
			$this->form_validation->set_rules('servicio_unidad_edit','Unidad','trim|required|max_length[4]');
			$this->form_validation->set_rules('servicio_tipo_edit','Tipo','trim|required|max_length[40]');
			

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$id_servicio = $this->security->xss_clean($this->input->post('id_servicio'));
				$db_data = array(
					'nombre' => $this->security->xss_clean($this->input->post('servicio_nombre_edit')),
					'unidad' => $this->security->xss_clean($this->input->post('servicio_unidad_edit')),
					'tipo' => $this->security->xss_clean($this->input->post('servicio_tipo_edit'))
				);

				$update_servicio = $this->servicio_model->update_servicio($id_servicio,$db_data);

				if($update_servicio){
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