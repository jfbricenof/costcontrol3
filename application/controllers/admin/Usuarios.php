<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/config_empleado_model');
        $this->load->model('admin/usuarios_model');
    }

	public function index(){
		$info_usuarios = $this->usuarios_model->get_info_usuarios();
		$info_empleados = $this->config_empleado_model->get_info_empleados();
		$data['empleados'] = $info_empleados;
		$data['usuarios'] = $info_usuarios;
		$this->mytemplate->loadAdmin('admin/usuarios', $data);
	}

	public function add_usuario(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('usuario_tipo','Tipo','trim|required|max_length[40]');
			$this->form_validation->set_rules('usuario_email','Email','trim|required|max_length[40]');
			$this->form_validation->set_rules('usuario_pw','Pw','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{

				$db_data = array(
					'id_empleado' => $this->security->xss_clean($this->input->post('empleado_id')),
					'tipo' => $this->security->xss_clean($this->input->post('usuario_tipo')),
					'email' => $this->security->xss_clean($this->input->post('usuario_email')),
					'pw' => password_hash($this->security->xss_clean($this->input->post('usuario_pw')), PASSWORD_DEFAULT)
				);

				$nuevo_usuario = $this->usuarios_model->ingresar_usuario($db_data);
				if ($nuevo_usuario) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function borrar_usuario($id_usuario){
		$del_usuario = $this->usuarios_model->delete_usuario($id_usuario);
		if($del_usuario){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function editar_usuario(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('usuario_tipo_edit','Tipo','trim|required|max_length[40]');
			$this->form_validation->set_rules('usuario_email_edit','Email','trim|required|max_length[40]');
			$this->form_validation->set_rules('usuario_pw_edit','pw','trim|required|max_length[40]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$id_usuario = $this->security->xss_clean($this->input->post('id_usuario'));
				$db_data = array(
					'tipo' => $this->security->xss_clean($this->input->post('usuario_tipo_edit')),
					'email' => $this->security->xss_clean($this->input->post('usuario_email_edit')),
					'pw' => password_hash($this->security->xss_clean($this->input->post('usuario_pw_edit')), PASSWORD_DEFAULT)
				);

				$update_usuario = $this->usuarios_model->update_usuario($id_usuario,$db_data);

				if($update_usuario){
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
