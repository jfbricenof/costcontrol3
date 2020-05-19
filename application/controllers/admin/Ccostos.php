<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ccostos extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/ccostos_model');
    }

	public function index(){
		$info_centros = $this->ccostos_model->get_info_centros();
		$data['centros'] = $info_centros;
		$this->mytemplate->loadAdmin('admin/ccostos', $data);
	}

	public function add_centro(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('centro_nombre','Centro de Costos','trim|required|max_length[40]');
			$this->form_validation->set_rules('centro_direccion','Direccion','trim|required|max_length[40]');
			$this->form_validation->set_rules('centro_responsable','Responsable','trim|required|max_length[40]');
			$this->form_validation->set_rules('centro_tel','Telefono','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{

				$db_data = array(
					'nombre' => $this->security->xss_clean($this->input->post('centro_nombre')),
					'direccion' => $this->security->xss_clean($this->input->post('centro_direccion')),
					'responsable' => $this->security->xss_clean($this->input->post('centro_responsable')),
					'tel' => $this->security->xss_clean($this->input->post('centro_tel'))
				);

				$nuevo_centro = $this->ccostos_model->ingresar_centro($db_data);
				if ($nuevo_centro) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function borrar_centro($id_ccostos){
		$del_centro = $this->ccostos_model->delete_centro($id_ccostos);
		if($del_centro){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function editar_centro(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('centro_nombre_edit','Centro de Costos','trim|required|max_length[40]');
			$this->form_validation->set_rules('centro_direccion_edit','Dirección','trim|required|max_length[40]');
			$this->form_validation->set_rules('centro_responsable_edit','Responsable','trim|required|max_length[40]');
			$this->form_validation->set_rules('centro_tel_edit','Telefono','trim|required|max_length[40]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$id_ccostos = $this->security->xss_clean($this->input->post('id_ccostos'));
				$db_data = array(
					'nombre' => $this->security->xss_clean($this->input->post('centro_nombre_edit')),
					'direccion' => $this->security->xss_clean($this->input->post('centro_direccion_edit')),
					'responsable' => $this->security->xss_clean($this->input->post('centro_responsable_edit')),
					'tel' => $this->security->xss_clean($this->input->post('centro_tel_edit'))
				);

				$editar_centro = $this->ccostos_model->editar_centro($id_ccostos,$db_data);

				if($editar_centro){
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
