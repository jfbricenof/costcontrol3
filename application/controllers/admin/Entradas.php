<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas extends CI_Controller {

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
        $this->load->model('admin/entradas_model');
        $this->load->model('admin/actividad_model');
    }

	public function index(){
		$info_ordenes = $this->orden_compra_model->get_info_ordenes_pendientes();
		$data['ordenes'] = $info_ordenes;
		$this->mytemplate->loadAdmin('admin/entradas_list', $data);
	}

	public function consultar(){
		$info_entrada = $this->entradas_model->get_info_entrada($this->uri->segment(4));
		$data = array(
			    'info' => $info_entrada,
			    'detalle' => $this->entradas_model->get_detalle_entrada($this->uri->segment(4))
			);
		$this->mytemplate->loadAdmin('admin/get_entrada',$data);
	}

	public function listas(){
		$info_entradas = $this->entradas_model->get_info_entradas();
		$data['entradas'] = $info_entradas;
		$this->mytemplate->loadAdmin('admin/lista_entradas', $data);
	}

	public function nueva_entrada(){
		$info_orden = $this->orden_compra_model->get_info_orden($this->uri->segment(4));
		$data = array(
			    'info' => $info_orden,
			    'detalle' => $this->orden_compra_model->get_detalle_orden_pendiente($this->uri->segment(4))
			);
		$this->mytemplate->loadAdmin('admin/crear_entrada',$data);
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

	public function crear_entrada(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('en_remision','Remisión','trim|required');
			$this->form_validation->set_rules('en_factura','Factura','trim|required|max_length[40]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$db_data = array(
					'fecha' => date('Y-m-d'),
					'id_OrdenCompra' => $this->security->xss_clean($this->input->post('id_OrdenCompra')),
					'observacion' => $this->security->xss_clean($this->input->post('observacion')),
					'subtotal' => $this->security->xss_clean($this->input->post('subtotal')),
					'total' => $this->security->xss_clean($this->input->post('total')),
					'factura' => $this->security->xss_clean($this->input->post('en_factura')),
					'remision' => $this->security->xss_clean($this->input->post('en_remision'))
				);

				$detalle_entrada = $this->security->xss_clean($this->input->post('detalle_entrada'));

				$nueva_entrada = $this->entradas_model->ingresar_entrada($db_data);
				if ($nueva_entrada) {
					for ($i = 0; $i < count($detalle_entrada); $i++) {
						$db_data2 = array(
							'id_entrada' => $nueva_entrada,
							'id_DetalleOrden' => $detalle_entrada[$i]["id_DetalleOrden"],
							'cant_material' => $detalle_entrada[$i]["cant_material"],
							'id_actividad' => $detalle_entrada[$i]["id_actividad"],
							'precio_unit_DetalleOrden' => $detalle_entrada[$i]["precio_unit"],
							'subtotal' => $detalle_entrada[$i]["subtotal"]
							
						);

						if (intval($detalle_entrada[$i]["cant_material"]) >= intval($detalle_entrada[$i]["cant_req"]) ) {
							$this->orden_compra_model->update_estado_detalle($detalle_entrada[$i]["id_DetalleOrden"]);
						}

						$this->entradas_model->ingresar_detalle_entrada($db_data2);
					}
					$detalle = $this->orden_compra_model->get_detalle_orden_pendiente($this->security->xss_clean($this->input->post('id_OrdenCompra')));

					if (count($detalle) < 1) {
						$this->orden_compra_model->update_estado($this->security->xss_clean($this->input->post('id_OrdenCompra')));
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