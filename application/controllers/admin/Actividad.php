<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/actividad_model');
    }

	public function index(){
		$info_actividades = $this->actividad_model->get_info_actividades();
		$data['actividades'] = $info_actividades;
		$this->mytemplate->loadAdmin('admin/actividad', $data);
	}

	public function add_actividad(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('actividad_nombre','Descripción','trim|required|max_length[40]');
			$this->form_validation->set_rules('actividad_presupuesto','Valor Presupuestado','trim|required|max_length[40]');
			$this->form_validation->set_rules('actividad_observacion','Observaciones','trim|required|max_length[80]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{

				$db_data = array(
					'nombre' => $this->security->xss_clean($this->input->post('actividad_nombre')),
					'presupuesto' => $this->security->xss_clean($this->input->post('actividad_presupuesto')),
					'observacion' => $this->security->xss_clean($this->input->post('actividad_observacion'))
				);

				$nuevo_actividad = $this->actividad_model->ingresar_actividad($db_data);
				if ($nuevo_actividad) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function borrar_actividad($id_actividad){
		$del_actividad = $this->actividad_model->delete_actividad($id_actividad);
		if($del_actividad){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_actividad(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('actividad_nombre_edit','Descripción','trim|required|max_length[40]');
			$this->form_validation->set_rules('actividad_presupuesto_edit','Valor Presupuestado','trim|required|max_length[40]');
			$this->form_validation->set_rules('actividad_observacion_edit','Observaciones','trim|required|max_length[80]');
			

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$id_actividad = $this->security->xss_clean($this->input->post('id_actividad'));
				$db_data = array(
					'nombre' => $this->security->xss_clean($this->input->post('actividad_nombre_edit')),
					'presupuesto' => $this->security->xss_clean($this->input->post('actividad_presupuesto_edit')),
					'observacion' => $this->security->xss_clean($this->input->post('actividad_observacion_edit'))
				);

				$update_actividad = $this->actividad_model->update_actividad($id_actividad,$db_data);

				if($update_actividad){
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