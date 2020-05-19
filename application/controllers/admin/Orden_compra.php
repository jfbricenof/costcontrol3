<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orden_compra extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/config_provee_model');
        $this->load->model('admin/config_general_model');
        $this->load->model('admin/material_model');
        $this->load->model('admin/config_empleado_model');
        $this->load->model('admin/orden_compra_model');
    }

	public function index(){
		$info_ordenes = $this->orden_compra_model->get_info_ordenes();
		$data['ordenes'] = $info_ordenes;
		$this->mytemplate->loadAdmin('admin/orden_compra_list', $data);
	}

	public function nueva_orden(){
		$this->mytemplate->loadAdmin('admin/orden_compra');
	}

	public function consultar(){
		$encabezado = $this->orden_compra_model->get_encabezado();
		$info_orden = $this->orden_compra_model->get_info_orden($this->uri->segment(4));
		$data = array(
		    'info' => $info_orden,
		    'detalle' => $this->orden_compra_model->get_detalle_orden($this->uri->segment(4)),
		    'encabezado'=>$encabezado
		);

		$this->mytemplate->loadAdmin('admin/get_orden_compra',$data);
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

	public function get_ivas(){
		if ($this->input->is_ajax_request()) {

			$get_ivas_reg = $this->config_general_model->get_info_ivas();

			if($get_ivas_reg){
				$data = array(
					'res'=>'success',
		            'datos'=> $get_ivas_reg
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
			$this->form_validation->set_rules('fecha_entrega','Fecha Entrega','trim|required');
			$this->form_validation->set_rules('cond_pago','Cond. Pago','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$db_data = array(
					'fecha' => date('Y-m-d'),
					'id_provee' => $this->security->xss_clean($this->input->post('id_provee')),
					'requisicion' => $this->security->xss_clean($this->input->post('requisicion')),
					'cond_pago' => $this->security->xss_clean($this->input->post('cond_pago')),
					'observacion' => $this->security->xss_clean($this->input->post('observacion')),
					'subtotal' => $this->security->xss_clean($this->input->post('subtotal')),
					'id_iva' => $this->security->xss_clean($this->input->post('id_iva')),
					'total' => $this->security->xss_clean($this->input->post('total')),
					'fecha_requi' => $this->security->xss_clean($this->input->post('fecha_requi')),
					'fecha_entrega' => $this->security->xss_clean($this->input->post('fecha_entrega')),
					'id_recibe' => $this->security->xss_clean($this->input->post('id_recibe')),
					'id_solicita' => 1
				);

				$detalle_orden = $this->security->xss_clean($this->input->post('detalle_orden'));

				$nueva_orden = $this->orden_compra_model->ingresar_orden($db_data);
				if ($nueva_orden) {
					for ($i = 0; $i < count($detalle_orden); $i++) {
						$db_data2 = array(
							'id_OrdenCompra' => $nueva_orden,
							'id_material' => $detalle_orden[$i]["id_material"],
							'cant_material' => $detalle_orden[$i]["cant_material"],
							'precio_unit' => $detalle_orden[$i]["precio_unit"],
							'subtotal' => $detalle_orden[$i]["subtotal"]
						);

						$this->orden_compra_model->ingresar_detalle_orden($db_data2);
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