<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salidas extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
       	$this->load->model('admin/material_model');
        $this->load->model('admin/salida_model');
    }

	public function index(){
		$info_salidas = $this->salida_model->get_info_salidas();
		$data['salidas'] = $info_salidas;
		$this->mytemplate->loadAdmin('admin/salida_list', $data);
	}

	public function nueva_salida(){
		//$info_actividades = $this->actividad_model->get_info_actividades();
		//$data['actividades'] = $info_actividades;
		$this->mytemplate->loadAdmin('admin/salida');
	}

	public function consultar(){
		$info_salida = $this->salida_model->get_info_salida($this->uri->segment(4));
		$data = array(
			    'info' => $info_salida,
			    'detalle' => $this->salida_model->get_detalle_salida($this->uri->segment(4))
			);
		$this->mytemplate->loadAdmin('admin/get_salida',$data);
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

	public function crear(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('vale','Vale','trim|required');
			$this->form_validation->set_rules('contratista','Contratista','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$db_data = array(
					'fecha' => date('Y-m-d'),
					'vale' => $this->security->xss_clean($this->input->post('vale')),
					'contratista' => $this->security->xss_clean($this->input->post('contratista')),
					'observacion' => $this->security->xss_clean($this->input->post('observacion')),
					
				);

				$detalle_salida = $this->security->xss_clean($this->input->post('detalle_salida'));

				$nueva_salida = $this->salida_model->ingresar_salida($db_data);
				if ($nueva_salida) {
					for ($i = 0; $i < count($detalle_salida); $i++) {
						$db_data2 = array(
							'id_salida' => $nueva_salida,
							'id_material' => $detalle_salida[$i]["id_material"],
							'cant_material' => $detalle_salida[$i]["cant_material"],
						);

						$this->salida_model->ingresar_detalle_salida($db_data2);
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