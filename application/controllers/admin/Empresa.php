<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/empresa_model');
	}
	public function index(){
		$this->mytemplate->loadAdmin('admin/empresa');
	}
	//funcion para ingresar Nueva Empresa
	public function registro(){
    	//hacemos las comprobaciones que deseemos en nuestro formulario
		$this->form_validation->set_rules('ne_nit','nit','trim|required|max_length[15]');
		$this->form_validation->set_rules('ne_nombre','Nombre','trim|required|max_length[20]');
		$this->form_validation->set_rules('ne_direccion','Direccion','trim|required|max_length[30]');
		$this->form_validation->set_rules('ne_ciudad','Ciudad','trim|required|max_length[15]');
		$this->form_validation->set_rules('ne_telfijo','Telefono','numeric|trim|required');
		$this->form_validation->set_rules('ne_telcelular','Celular','trim|required');
		$this->form_validation->set_rules('ne_email','email','trim|valid_email|required');
		
		
		if (!$this->form_validation->run()){
			//si no pasamos la validación volvemos al formulario mostrando los errores
			$this->index();
		}
		//si pasamos la validación correctamente pasamos a hacer la inserción en la base de datos
		else{
			$nit = $this->security->xss_clean($this->input->post('ne_nit'));	
			$nombre = $this->security->xss_clean($this->input->post('ne_nombre'));
			$direccion = $this->security->xss_clean($this->input->post('ne_direccion'));
			$ciudad = $this->security->xss_clean($this->input->post('ne_ciudad'));				
			$fijo = $this->security->xss_clean($this->input->post('ne_telfijo'));
			$celular = $this->security->xss_clean($this->input->post('ne_telcelular'));
			$email = $this->security->xss_clean($this->input->post('ne_email'));
			//ahora procesamos los datos hacía el modelo que debemos crear
			$nueva_empresa = $this->empresa_model->ingresar_empresa(
				$this->session->userdata('id_cuenta'),
				$nit,
				$nombre,
				$direccion,
				$ciudad,
				$fijo,
				$celular,
				$email
			);
			if($nueva_empresa){
				redirect(base_url("admin/panel"), "refresh");
			}else{
				echo "Error";
			}
		}
    }
}
