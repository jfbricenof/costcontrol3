<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_empleado extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/config_empleado_model');
    }

	public function index(){
		$info_empleados = $this->config_empleado_model->get_info_empleados();
		$data['empleados'] = $info_empleados;
		$this->mytemplate->loadAdmin('admin/config_empleado', $data);
	}

	public function add_empleado(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('empleado_id','Identificacion','trim|required|max_length[40]');
			$this->form_validation->set_rules('empleado_nombre','Nombre','trim|required|max_length[40]');
			$this->form_validation->set_rules('empleado_apellido','Apellido','trim|required|max_length[40]');
			$this->form_validation->set_rules('empleado_telefono','Telefono','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{

				$db_data = array(
					'id_empleado' => $this->security->xss_clean($this->input->post('empleado_id')),
					'nombre' => $this->security->xss_clean($this->input->post('empleado_nombre')),
					'apellido' => $this->security->xss_clean($this->input->post('empleado_apellido')),
					'telefono' => $this->security->xss_clean($this->input->post('empleado_telefono'))
				);

				$nuevo_empleado = $this->config_empleado_model->ingresar_empleado($db_data);
				if ($nuevo_empleado) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function borrar_empleado($id_empleado){
		$del_empleado = $this->config_empleado_model->delete_empleado($id_empleado);
		if($del_empleado){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_empleado(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('empleado_nombre_edit','Nombre','trim|required|max_length[40]');
			$this->form_validation->set_rules('empleado_apellido_edit','Apellido','trim|required|max_length[40]');
			$this->form_validation->set_rules('empleado_telefono_edit','Telefono','trim|required|max_length[40]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$id_empleado = $this->security->xss_clean($this->input->post('id_empleado'));
				$db_data = array(
					'nombre' => $this->security->xss_clean($this->input->post('empleado_nombre_edit')),
					'apellido' => $this->security->xss_clean($this->input->post('empleado_apellido_edit')),
					'telefono' => $this->security->xss_clean($this->input->post('empleado_telefono_edit'))
				);

				$update_empleado = $this->config_empleado_model->update_empleado($id_empleado,$db_data);

				if($update_empleado){
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
