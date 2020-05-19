<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_presupuesto extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/config_presupuesto_model');
    }

	public function index(){
		$idempresa = $this->session->userdata('empresa')->id_empresa;
		$empresa = $this->config_presupuesto_model->get_empresa($idempresa);
		$data['empresa'] = $empresa;
		$tipos_inm = $this->config_presupuesto_model->get_tipos_inmueble($idempresa);
		$data['tipos_inmueble'] = $tipos_inm;
		$tarifas = $this->config_presupuesto_model->get_tarifas($idempresa);
		$data['tarifas'] = $tarifas;
		$data['rubros'] = $this->config_presupuesto_model->get_rubros($idempresa);

		$this->mytemplate->loadAdmin('admin/config_presupuesto', $data);
	}

	public function add_tarifa(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('add_tipo_inmueble','Tipo de Inmueble','trim|required|max_length[3]');
			$this->form_validation->set_rules('add_fecha_inicio','Fecha de Inicio','trim|required|max_length[10]');
			$this->form_validation->set_rules('add_fecha_fin','Fecha de Fin','trim|required|max_length[10]');
			$this->form_validation->set_rules('add_valor','Valor Tarifa','trim|required|numeric|max_length[10]');
			$this->form_validation->set_rules('add_descripcion','Descripción Tarifa','trim|required|max_length[140]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$tipo_inm = $this->security->xss_clean($this->input->post('add_tipo_inmueble'));
				$fecha_inicio = $this->security->xss_clean($this->input->post('add_fecha_inicio'));
				$fecha_fin = $this->security->xss_clean($this->input->post('add_fecha_fin'));
				$valor = $this->security->xss_clean($this->input->post('add_valor'));
				$descripcion = $this->security->xss_clean($this->input->post('add_descripcion'));

				$db_data = array(
					'id_tipo_inmueble' => $tipo_inm,
					'fecha_inicio' => $fecha_inicio,
					'fecha_fin' => $fecha_fin,
					'descripcion' => $descripcion,
					'valor_admin' => $valor,
					'estado' => 1, // inicia activo
					'id_user' => $this->session->userdata('id_user')
				);

				$insert_tarifa = $this->config_presupuesto_model->insert_tarifa($db_data);

				if($insert_tarifa){

					$ruta_edit = base_url().'admin/config_presupuesto/edit_tarifa/'.$insert_tarifa;
					$ruta_del = base_url().'admin/config_presupuesto/borrar_tarifa/'.$insert_tarifa;

					$data = array(
								"res"=>"success",
								"ruta_edit"=>$ruta_edit,
								"ruta_del"=>$ruta_del,
								"tipo_inm"=>$tipo_inm,
								"fecha_inicio"=>$fecha_inicio,
								"fecha_fin"=>$fecha_fin,
								"valor"=>$valor,
								"descripcion"=>$descripcion
								);
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{

		}
	}

	public function borrar_tarifa($id_tarifa){
		$del_tarifa = $this->config_presupuesto_model->delete_tarifa($id_tarifa);
		if($del_tarifa){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_tarifa($id_tarifa){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('edit_id_tinmueble','Tipo de Inmueble','trim|required|max_length[3]');
			$this->form_validation->set_rules('edit_fecha_inicio','Fecha de Inicio','trim|required|max_length[10]');
			$this->form_validation->set_rules('edit_fecha_fin','Fecha de Fin','trim|required|max_length[10]');
			$this->form_validation->set_rules('edit_valor','Valor Tarifa','trim|required|numeric|max_length[12]');
			$this->form_validation->set_rules('edit_tasamora','Tasa Interes por Mora','trim|required|numeric|max_length[12]');
			$this->form_validation->set_rules('edit_tasa_iva','Porcentaje de Iva','trim|required|numeric|max_length[12]');

			$this->form_validation->set_rules('edit_descripcion','Descripción Tarifa','trim|required|max_length[140]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$id_tipo_inm = $this->security->xss_clean($this->input->post('edit_id_tinmueble'));
				$fecha_inicio = $this->security->xss_clean($this->input->post('edit_fecha_inicio'));
				$fecha_fin = $this->security->xss_clean($this->input->post('edit_fecha_fin'));
				$valor = $this->security->xss_clean($this->input->post('edit_valor'));
				$tasa_mora = $this->security->xss_clean($this->input->post('edit_tasamora'));
				$tasa_iva = $this->security->xss_clean($this->input->post('edit_tasa_iva'));
				$descripcion = $this->security->xss_clean($this->input->post('edit_descripcion'));

				$db_data = array(
					'id_tipo_inmueble' => $id_tipo_inm,
					'fecha_inicio' => $fecha_inicio,
					'fecha_fin' => $fecha_fin,
					'descripcion' => $descripcion,
					'valor_admin' => $valor,
					'tasa_interes_mora' => $tasa_mora,
					'tasa_iva' => $tasa_iva,
					'id_user' => $this->session->userdata('id_user')
				);

				$update_tarifa = $this->config_presupuesto_model->update_tarifa($id_tarifa,$db_data);

				if($update_tarifa){
					$data = array(
								"res"=>"success",
								"fecha_inicio"=>$fecha_inicio,
								"fecha_fin"=>$fecha_fin,
								"valor"=>$valor,
								"tasa_mora"=>$tasa_mora,
								"tasa_iva"=>$tasa_iva,
								"descripcion"=>$descripcion
								);
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{

		}
	}

	public function add_rubro(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('rub_nombre','Nombre','trim|required|max_length[40]');
			$this->form_validation->set_rules('rub_descripcion','Descripción','trim|required|max_length[200]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$rub_nombre = $this->security->xss_clean($this->input->post('rub_nombre'));
				$rub_descripcion = $this->security->xss_clean($this->input->post('rub_descripcion'));

				$db_data = array(
					'nombre' => $rub_nombre,
					'descripcion' => $rub_descripcion,
					'id_usuario_reg' => $this->session->userdata('id_user'),
					'id_empresa' => $this->session->userdata('empresa')->id_empresa
				);

				$nuevo_rubro = $this->config_presupuesto_model->ingresar_rubro($db_data);
				if ($nuevo_rubro) {
					$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"rub_nombre"=>$rub_nombre,
								"rub_descripcion"=>$rub_descripcion,
								"id"=>$nuevo_rubro);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	function eliminar_rubro(){
		if ($this->input->is_ajax_request()) {
			$id = $this->security->xss_clean($this->input->post('id_tipo_rubro'));
			$query=$this->config_presupuesto_model->eliminar_rubro($id);
			if ($query) {
				$data = array("res"=>"success");
			} else {
				$data = array("res"=>"error");
			}
        	echo json_encode($data);
		}
    }

    public function editar_rubro($id_rub){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('edit_rub_nombre','Nombre','trim|required|max_length[20]');
			$this->form_validation->set_rules('edit_rub_descripcion','Descripción','trim|required|max_length[200]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$nombre = $this->security->xss_clean($this->input->post('edit_rub_nombre'));
				$desc = $this->security->xss_clean($this->input->post('edit_rub_descripcion'));
				$db_data = array(
					'nombre' => $nombre,
					'descripcion' => $desc
				);

				$editar_rubro = $this->config_presupuesto_model->editar_rubro($id_rub,$db_data);
				if ($editar_rubro) {
					$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"nombre"=>$nombre,
								"id"=>$id_rub,
								"descripcion"=>$desc);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}
}
