<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devolucion extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/config_provee_model');
        $this->load->model('admin/config_general_model');
        $this->load->model('admin/material_model');
        $this->load->model('admin/config_empleado_model');
        $this->load->model('admin/actividad_model');
        $this->load->model('admin/devolucion_model');
    }

	public function index(){
		$info_devoluciones = $this->devolucion_model->get_info_devoluciones();
		$data['devoluciones'] = $info_devoluciones;
		$this->mytemplate->loadAdmin('admin/devolucion_list', $data);
	}

	public function nueva_devolucion(){
		//$info_actividades = $this->actividad_model->get_info_actividades();
		//$data['actividades'] = $info_actividades;
		$this->mytemplate->loadAdmin('admin/devolucion');
	}

	public function consultar(){
		$info_devolucion = $this->devolucion_model->get_info_devolucion($this->uri->segment(4));
		$data = array(
			    'info' => $info_devolucion,
			    'detalle' => $this->devolucion_model->get_detalle_devolucion($this->uri->segment(4))
			);
		$this->mytemplate->loadAdmin('admin/get_devolucion',$data);
	}

	public function get_actividades(){
		if ($this->input->is_ajax_request()) {

			$get_actividad_reg = $this->actividad_model->get_info_actividades();

			if($get_actividad_reg){
				$data = array(
					'res'=>'success',
		            'datos'=> $get_actividad_reg
		        );
			}else{
				$data = array("res"=>"error3");
			}
			echo json_encode($data);
		}
	}

	public function get_proveedor(){
		if ($this->input->is_ajax_request()) {

			$get_provee_reg = $this->config_provee_model->get_info_proves();

			if($get_provee_reg){
				$data = array(
					'res'=>'success',
		            'datos'=> $get_provee_reg
		        );
			}else{
				$data = array("res"=>"error3");
			}
			echo json_encode($data);
		}
	}

	
	public function get_materiales(){
		if ($this->input->is_ajax_request()) {

			$get_mat_reg = $this->material_model->get_info_materiales();

			if($get_mat_reg){
				$data = array(
					'res'=>'success',
		            'datos'=> $get_mat_reg
		        );
			}else{
				$data = array("res"=>"error3");
			}
			echo json_encode($data);
		}
	}

	public function get_empleado(){
		if ($this->input->is_ajax_request()) {

			$get_empleado_reg = $this->config_empleado_model->get_info_empleados();

			if($get_empleado_reg){
				$data = array(
					'res'=>'success',
		            'datos'=> $get_empleado_reg
		        );
			}else{
				$data = array("res"=>"error3");
			}
			echo json_encode($data);
		}
	}

	public function crear(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('observacion','Observacion','trim|required');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$db_data = array(
					'fecha' => date('Y-m-d'),
					'id_provee' => $this->security->xss_clean($this->input->post('id_provee')),
					'observacion' => $this->security->xss_clean($this->input->post('observacion')),
					'subtotal' => $this->security->xss_clean($this->input->post('subtotal')),
					'total' => $this->security->xss_clean($this->input->post('total')),
					'id_solicita' => 1
				);

				$detalle_devolucion = $this->security->xss_clean($this->input->post('detalle_devolucion'));

				$nueva_devolucion = $this->devolucion_model->ingresar_devolucion($db_data);
				if ($nueva_devolucion) {
					for ($i = 0; $i < count($detalle_devolucion); $i++) {
						$db_data2 = array(
							'id_devolucion' => $nueva_devolucion,
							'id_material' => $detalle_devolucion[$i]["id_material"],
							'cant_material' => $detalle_devolucion[$i]["cant_material"],
							'id_actividad' => $detalle_devolucion[$i]["id_actividad"],
							'precio_unit' => $detalle_devolucion[$i]["precio_unit"],
							'subtotal' => $detalle_devolucion[$i]["subtotal"],
						);

						$this->devolucion_model->ingresar_detalle_devolucion($db_data2);
					}
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);

		}else{
			$data= array('res' => "error");
		}
	}
}