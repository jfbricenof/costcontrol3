<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reintegro extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
       	$this->load->model('admin/material_model');
        $this->load->model('admin/reintegro_model');
    }

	public function index(){
		$info_reintegro = $this->reintegro_model->get_info_reintegros();
		$data['reintegros'] = $info_reintegro;
		$this->mytemplate->loadAdmin('admin/reintegro_list', $data);
	}

	public function nueva_reintegro(){
		//$info_actividades = $this->actividad_model->get_info_actividades();
		//$data['actividades'] = $info_actividades;
		$this->mytemplate->loadAdmin('admin/reintegro');
	}

	public function consultar(){
		$info_reintegro = $this->reintegro_model->get_info_reintegro($this->uri->segment(4));
		$data = array(
			    'info' => $info_reintegro,
			    'detalle' => $this->reintegro_model->get_detalle_reintegro($this->uri->segment(4))
			);
		$this->mytemplate->loadAdmin('admin/get_reintegro',$data);
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
			$this->form_validation->set_rules('contratista','Contratista','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$db_data = array(
					'fecha' => date('Y-m-d'),
					'contratista' => $this->security->xss_clean($this->input->post('contratista')),
					'observacion' => $this->security->xss_clean($this->input->post('observacion')),
					
				);

				$detalle_reintegro = $this->security->xss_clean($this->input->post('detalle_reintegro'));

				$nueva_reintegro = $this->reintegro_model->ingresar_reintegro($db_data);
				if ($nueva_reintegro) {
					for ($i = 0; $i < count($detalle_reintegro); $i++) {
						$db_data2 = array(
							'id_reintegro' => $nueva_reintegro,
							'id_material' => $detalle_reintegro[$i]["id_material"],
							'cant_material' => $detalle_reintegro[$i]["cant_material"],
						);

						$this->reintegro_model->ingresar_detalle_reintegro($db_data2);
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