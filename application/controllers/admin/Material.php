<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/material_model');
        $this->load->model('admin/servicio_model');

    }

	public function index(){
		$info_materiales = $this->material_model->get_info_materiales();
		$data['materiales'] = $info_materiales;
		$info_servicios = $this->servicio_model->get_info_servicios();
		$data['servicios'] = $info_servicios;
		$this->mytemplate->loadAdmin('admin/material', $data);
	}

	public function add_material(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('material_nombre','Descripción','trim|required|max_length[40]');
			$this->form_validation->set_rules('material_unidad','Unidad','trim|required|max_length[4]');
			$this->form_validation->set_rules('material_tipo','Tipo','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{

				$db_data = array(
					'nombre' => $this->security->xss_clean($this->input->post('material_nombre')),
					'unidad' => $this->security->xss_clean($this->input->post('material_unidad')),
					'tipo' => $this->security->xss_clean($this->input->post('material_tipo'))
				);

				$nuevo_material = $this->material_model->ingresar_material($db_data);
				if ($nuevo_material) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function borrar_material($id_material){
		$del_material = $this->material_model->delete_material($id_material);
		if($del_material){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_material(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('material_nombre_edit','Descripción','trim|required|max_length[40]');
			$this->form_validation->set_rules('material_unidad_edit','Unidad','trim|required|max_length[4]');
			$this->form_validation->set_rules('material_tipo_edit','Tipo','trim|required|max_length[40]');
			

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$id_material = $this->security->xss_clean($this->input->post('id_material'));
				$db_data = array(
					'nombre' => $this->security->xss_clean($this->input->post('material_nombre_edit')),
					'unidad' => $this->security->xss_clean($this->input->post('material_unidad_edit')),
					'tipo' => $this->security->xss_clean($this->input->post('material_tipo_edit'))
				);

				$update_material = $this->material_model->update_material($id_material,$db_data);

				if($update_material){
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