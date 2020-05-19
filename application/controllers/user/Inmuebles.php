<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inmuebles extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/persona_model');
        $this->load->model('admin/inmuebles_model');
        $this->load->model('admin/config_inmueble_model');
        $this->load->model('admin/residente_model');
        $this->load->model('admin/vehiculo_model');
        $this->load->model('admin/mascota_model');
        $this->load->model('admin/solicitud_model');
        $this->load->model('admin/parqueadero_model');
        $this->load->model('admin/factura_model');
        $this->load->model('admin/notas_inmueble_model');
        $this->load->model('admin/pagos_model');
    }

	public function index(){
		$inm= $this->persona_model->obtener_inmueble($this->session->userdata('id_persona'));
		$info_inmueble = $this->inmuebles_model->obtener_inmueble($inm[0]->id_inmueble);
		if (!$info_inmueble) {
			redirect(base_url().'admin/pagina_404');
		} else {
			$info_propietario= $this->persona_model->obtener_persona($info_inmueble[0]->id_propietario);
			$info_responsable= $this->persona_model->obtener_persona($info_inmueble[0]->id_responsable);
			$info_residentes= $this->residente_model->obtener_residentes($inm[0]->id_inmueble);
			$info_vehiculos= $this->vehiculo_model->obtener_vehiculos($inm[0]->id_inmueble);
			$info_mascotas= $this->mascota_model->obtener_mascotas($inm[0]->id_inmueble);
			$info_solicitudes= $this->solicitud_model->obtener_solicitudes($inm[0]->id_inmueble);
			$info_park= $this->parqueadero_model->obtener_parqueadero($inm[0]->id_inmueble);
			$info_facturas= $this->factura_model->obtener_facturas($inm[0]->id_inmueble);
			$info_notas= $this->notas_inmueble_model->obtener_notas($inm[0]->id_inmueble);
			$tipos_pago= $this->pagos_model->obtener_tipos();
			$data = array(
			    'inmueble' => $info_inmueble,
			    'propietario'=>$info_propietario,
			    'responsable'=>$info_responsable,
			    'residentes'=>$info_residentes,
			    'vehiculos'=>$info_vehiculos,
			    'mascotas'=>$info_mascotas,
			    'mensajes'=>$info_solicitudes,
			    'park'=>$info_park,
			    'facturas'=>$info_facturas,
			    'notas'=>$info_notas,
			    'tipos_pago'=>$tipos_pago
			);

			$this->mytemplate->loadAdminUser('user/info_inmueble',$data);
		}
	}

	public function actualizar_persona(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('inm_idpro','ID Propietario','trim|required|numeric|max_length[15]');
			$this->form_validation->set_rules('inm_nombre','Nombres','trim|required|max_length[20]');
			$this->form_validation->set_rules('inm_apellidos','Apellidos','trim|required|max_length[20]');
			$this->form_validation->set_rules('inm_email','Email','trim|valid_email|required');
			$this->form_validation->set_rules('inm_telefono','Telefono','trim|numeric|required');
			$this->form_validation->set_rules('inm_celular','Celular','trim|numeric|required');

			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$dni_prop = $this->security->xss_clean($this->input->post('inm_idpro'));
				$nombre = $this->security->xss_clean($this->input->post('inm_nombre'));
				$apellidos = $this->security->xss_clean($this->input->post('inm_apellidos'));
				$correo = $this->security->xss_clean($this->input->post('inm_email'));
				$telfijo = $this->security->xss_clean($this->input->post('inm_telefono'));
				$celular = $this->security->xss_clean($this->input->post('inm_celular'));

				$id_per = $this->security->xss_clean($this->input->post('id_persona'));

				$actualizar_persona = $this->persona_model->actualizar_persona(
					$dni_prop,
					$nombre,
					$apellidos,
					$correo,
					$telfijo,
					$celular,
					$id_per
				);
				if ($actualizar_persona) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function actualizar_responsable(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('inm_idres','ID Responsable','trim|required|numeric|max_length[15]');
			$this->form_validation->set_rules('inm_nombre_res','Nombres','trim|required|max_length[20]');
			$this->form_validation->set_rules('inm_apellidos_res','Apellidos','trim|required|max_length[20]');
			$this->form_validation->set_rules('inm_email_res','Email','trim|valid_email|required');
			$this->form_validation->set_rules('inm_telefono_res','Telefono','trim|numeric|required');
			$this->form_validation->set_rules('inm_celular_res','Celular','trim|numeric|required');

			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$dni_prop = $this->security->xss_clean($this->input->post('inm_idres'));
				$nombre = $this->security->xss_clean($this->input->post('inm_nombre_res'));
				$apellidos = $this->security->xss_clean($this->input->post('inm_apellidos_res'));
				$correo = $this->security->xss_clean($this->input->post('inm_email_res'));
				$telfijo = $this->security->xss_clean($this->input->post('inm_telefono_res'));
				$celular = $this->security->xss_clean($this->input->post('inm_celular_res'));

				$id_per = $this->security->xss_clean($this->input->post('id_persona'));

				$actualizar_persona = $this->persona_model->actualizar_persona(
					$dni_prop,
					$nombre,
					$apellidos,
					$correo,
					$telfijo,
					$celular,
					$id_per
				);
				if ($actualizar_persona) {
					$data = array("res"=>"success");
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function agregar_residente(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('res_idpro','ID Propietario','trim|required|numeric|max_length[15]');
			$this->form_validation->set_rules('res_nombre','Nombres','trim|required|max_length[20]');
			$this->form_validation->set_rules('res_apellidos','Apellidos','trim|required|max_length[20]');
			$this->form_validation->set_rules('res_email','Email','trim|valid_email|required');
			$this->form_validation->set_rules('res_telefono','Telefono','trim|numeric|required');
			$this->form_validation->set_rules('res_celular','Celular','trim|numeric|required');

			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$dni = $this->security->xss_clean($this->input->post('res_idpro'));
				$nombre = $this->security->xss_clean($this->input->post('res_nombre'));
				$apellidos = $this->security->xss_clean($this->input->post('res_apellidos'));
				$correo = $this->security->xss_clean($this->input->post('res_email'));
				$telfijo = $this->security->xss_clean($this->input->post('res_telefono'));
				$celular = $this->security->xss_clean($this->input->post('res_celular'));
				$id_inmueble = $this->security->xss_clean($this->input->post('id_inmueble'));

				$nueva_persona = $this->persona_model->ingresar_persona(
					$dni,
					2,
					$nombre,
					$apellidos,
					$correo,
					$telfijo,
					$celular,
					"Residente",
					1
				);
				if ($nueva_persona) {
					$nuevo_residente=$this->residente_model->ingresar_residente(
						$id_inmueble,
						$nueva_persona,
						1
					);
					if ($nuevo_residente) {
						$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"dni_residente"=>$dni,
								"nombre"=>$nombre,
								"apellidos"=>$apellidos,
								"email"=>$correo,
								"celular"=>$celular,
								"telefono"=>$telfijo,
								"id_residente"=>$nuevo_residente,
								"id_persona"=>$nueva_persona);
					}
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function editar_residente($id_res){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('res_idpro_edit','ID Propietario','trim|required|numeric|max_length[15]');
			$this->form_validation->set_rules('res_nombre_edit','Nombres','trim|required|max_length[20]');
			$this->form_validation->set_rules('res_apellidos_edit','Apellidos','trim|required|max_length[20]');
			$this->form_validation->set_rules('res_email_edit','Email','trim|valid_email|required');
			$this->form_validation->set_rules('res_telefono_edit','Telefono','trim|numeric|required');
			$this->form_validation->set_rules('res_celular_edit','Celular','trim|numeric|required');

			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$dni = $this->security->xss_clean($this->input->post('res_idpro_edit'));
				$nombre = $this->security->xss_clean($this->input->post('res_nombre_edit'));
				$apellidos = $this->security->xss_clean($this->input->post('res_apellidos_edit'));
				$correo = $this->security->xss_clean($this->input->post('res_email_edit'));
				$telfijo = $this->security->xss_clean($this->input->post('res_telefono_edit'));
				$celular = $this->security->xss_clean($this->input->post('res_celular_edit'));
				$id_persona = $this->security->xss_clean($this->input->post('id_persona_edit'));

				$db_data = array(
					'dni_persona' => $dni,
					'nombres' => $nombre,
					'apellidos' => $apellidos,
					'correo' => $correo,
					'tel_fijo' => $telfijo,
					'tel_celular' => $celular
				);

				$editar_residente = $this->residente_model->editar_residente($id_persona,$db_data);
				if ($editar_residente) {
					$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"dni_residente"=>$dni,
								"nombre"=>$nombre,
								"apellidos"=>$apellidos,
								"email"=>$correo,
								"celular"=>$celular,
								"telefono"=>$telfijo,
								"id_residente"=>$id_res);
				}

			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function agregar_vehiculo(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('veh_placa','Placa','trim|required|max_length[15]');
			$this->form_validation->set_rules('veh_marca','Marca','trim|required|max_length[20]');
			$this->form_validation->set_rules('veh_color','Color','trim|required|max_length[20]');
			$this->form_validation->set_rules('veh_desc','Descripción','trim|max_length[200]|required');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$veh_placa = $this->security->xss_clean($this->input->post('veh_placa'));
				$veh_marca = $this->security->xss_clean($this->input->post('veh_marca'));
				$veh_color = $this->security->xss_clean($this->input->post('veh_color'));
				$veh_desc = $this->security->xss_clean($this->input->post('veh_desc'));
				$id_inmueble = $this->security->xss_clean($this->input->post('id_inmueble'));

				$nuevo_vehiculo = $this->vehiculo_model->ingresar_vehiculo(
					$id_inmueble,
					$veh_placa,
					$veh_marca,
					$veh_color,
					$veh_desc,
					1
				);
				if ($nuevo_vehiculo) {
					$data = array("res"=>"success",
								"id"=>$nuevo_vehiculo,
								"url"=> base_url().'admin/',
								"veh_placa"=>$veh_placa,
								"veh_marca"=>$veh_marca,
								"veh_color"=>$veh_color,
								"veh_desc"=>$veh_desc);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function editar_vehiculo($id_veh){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('veh_placa_edit','Placa','trim|required|max_length[15]');
			$this->form_validation->set_rules('veh_marca_edit','Marca','trim|required|max_length[20]');
			$this->form_validation->set_rules('veh_color_edit','Color','trim|required|max_length[20]');
			$this->form_validation->set_rules('veh_desc_edit','Descripción','trim|max_length[200]|required');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$veh_placa = $this->security->xss_clean($this->input->post('veh_placa_edit'));
				$veh_marca = $this->security->xss_clean($this->input->post('veh_marca_edit'));
				$veh_color = $this->security->xss_clean($this->input->post('veh_color_edit'));
				$veh_desc = $this->security->xss_clean($this->input->post('veh_desc_edit'));


				$db_data = array(
					'placa' => $veh_placa,
					'marca' => $veh_marca,
					'color' => $veh_color,
					'descripcion' => $veh_desc
				);

				$editar_vehiculo = $this->vehiculo_model->editar_vehiculo($id_veh,$db_data);
				if ($editar_vehiculo) {
					$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"id"=>$id_veh,
								"veh_placa"=>$veh_placa,
								"veh_marca"=>$veh_marca,
								"veh_color"=>$veh_color,
								"veh_desc"=>$veh_desc);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function agregar_mascota(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('mas_tipo','Tipo','trim|required|max_length[15]');
			$this->form_validation->set_rules('mas_nombre','Nombre','trim|required|max_length[20]');
			$this->form_validation->set_rules('mas_raza','Raza','trim|required|max_length[20]');
			$this->form_validation->set_rules('mas_desc','Descripción','trim|max_length[200]|required');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$mas_tipo = $this->security->xss_clean($this->input->post('mas_tipo'));
				$mas_nombre = $this->security->xss_clean($this->input->post('mas_nombre'));
				$mas_raza = $this->security->xss_clean($this->input->post('mas_raza'));
				$mas_desc = $this->security->xss_clean($this->input->post('mas_desc'));
				$id_inmueble = $this->security->xss_clean($this->input->post('id_inmueble'));

				$nueva_mascota = $this->mascota_model->ingresar_mascota(
					$id_inmueble,
					$mas_tipo,
					$mas_nombre,
					$mas_raza,
					$mas_desc
				);
				if ($nueva_mascota) {
					$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"mas_tipo"=>$mas_tipo,
								"mas_nombre"=>$mas_nombre,
								"mas_raza"=>$mas_raza,
								"mas_desc"=>$mas_desc,
								"id"=>$nueva_mascota);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function editar_mascota($id_mas){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('mas_tipo_edit','Tipo','trim|required|max_length[15]');
			$this->form_validation->set_rules('mas_nombre_edit','Nombre','trim|required|max_length[20]');
			$this->form_validation->set_rules('mas_raza_edit','Raza','trim|required|max_length[20]');
			$this->form_validation->set_rules('mas_desc_edit','Descripción','trim|max_length[200]|required');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$mas_tipo = $this->security->xss_clean($this->input->post('mas_tipo_edit'));
				$mas_nombre = $this->security->xss_clean($this->input->post('mas_nombre_edit'));
				$mas_raza = $this->security->xss_clean($this->input->post('mas_raza_edit'));
				$mas_desc = $this->security->xss_clean($this->input->post('mas_desc_edit'));
				$id_inmueble = $this->security->xss_clean($this->input->post('id_inmueble'));


				$db_data = array(
					'tipo' => $mas_tipo,
					'nombre' => $mas_nombre,
					'raza' => $mas_raza,
					'descripcion' => $mas_desc
				);

				$editar_mascota = $this->mascota_model->editar_mascota($id_mas,$db_data);
				if ($editar_mascota) {
					$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"mas_tipo"=>$mas_tipo,
								"mas_nombre"=>$mas_nombre,
								"mas_raza"=>$mas_raza,
								"mas_desc"=>$mas_desc,
								"id"=>$id_mas);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	function eliminar_vehiculo(){
		if ($this->input->is_ajax_request()) {
			$id = $this->security->xss_clean($this->input->post('id_vehiculo'));
			$query=$this->vehiculo_model->eliminar_vehiculo($id);
			if ($query) {
				$data = array("res"=>"success");
			} else {
				$data = array("res"=>"error");
			}
        	echo json_encode($data);
		}
    }

    function eliminar_residente(){
		if ($this->input->is_ajax_request()) {
			$id_per = $this->security->xss_clean($this->input->post('id_persona'));
			$id_res = $this->security->xss_clean($this->input->post('id_residente'));
			$query=$this->residente_model->eliminar_residente($id_res);
			if ($query) {
				$query2=$this->persona_model->eliminar_persona($id_per);
				if ($query2) {
					$data = array("res"=>"success");
				}

			} else {
				$data = array("res"=>"error");
			}
        	echo json_encode($data);
		}
    }

    function ver_factura($id_fac){
		if ($this->input->is_ajax_request()) {
			$query=$this->factura_model->obtener_detalle_factura($id_fac);
			if ($query) {
				$data = array("res"=>"success","detalles"=>$query);
			}
        	echo json_encode($data);
		}
    }
    public function agregar_nota(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('not_nota','Nota','trim|required|max_length[250]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$nota = $this->security->xss_clean($this->input->post('not_nota'));
				$id_inmueble = $this->security->xss_clean($this->input->post('id_inmueble'));

				$db_data = array(
					'id_inmueble' => $id_inmueble,
					'nota' => $nota
				);

				$nueva_nota = $this->notas_inmueble_model->ingresar_nota($db_data);
				if ($nueva_nota) {
					$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"nota"=>$nota,
								"fecha_registro"=>date("Y-m-d H:i:s"),
								"id"=>$nueva_nota);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function agregar_park(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('park_numero','Número','trim|required|max_length[10]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$numero = $this->security->xss_clean($this->input->post('park_numero'));
				$id_inmueble = $this->security->xss_clean($this->input->post('id_inmueble'));

				$db_data = array(
					'id_inmueble' => $id_inmueble,
					'numero' => $numero
				);

				$nuevo_park = $this->parqueadero_model->ingresar_parqueadero($db_data);
				if ($nuevo_park) {
					$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"numero"=>$numero,
								"fecha_registro"=>date("Y-m-d H:i:s"),
								"id"=>$nuevo_park);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	public function editar_nota($id_not){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('not_nota_edit','Tipo','trim|required|max_length[250]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$nota = $this->security->xss_clean($this->input->post('not_nota_edit'));

				$db_data = array(
					'nota' => $nota,
				);

				$editar_nota = $this->notas_inmueble_model->editar_nota($id_not,$db_data);
				if ($editar_nota) {
					$data = array("res"=>"success",
								"url"=> base_url().'admin/',
								"nota"=>$nota,
								"id"=>$id_not);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

	function eliminar_nota(){
		if ($this->input->is_ajax_request()) {
			$id = $this->security->xss_clean($this->input->post('id_nota'));
			$query=$this->notas_inmueble_model->eliminar_nota($id);
			if ($query) {
				$data = array("res"=>"success");
			} else {
				$data = array("res"=>"error");
			}
        	echo json_encode($data);
		}
    }

    function eliminar_park(){
		if ($this->input->is_ajax_request()) {
			$id = $this->security->xss_clean($this->input->post('id_park'));
			$query=$this->parqueadero_model->eliminar_parqueadero($id);
			if ($query) {
				$data = array("res"=>"success");
			} else {
				$data = array("res"=>"error");
			}
        	echo json_encode($data);
		}
    }

    public function pagar_factura(){
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('pa_recibo','# Recibo','trim|required|max_length[20]');
			$this->form_validation->set_rules('pa_valor','# Valor Pago','trim|required|max_length[100]');
			if (!$this->form_validation->run()){
				$data= array('res' => "error",'errors'=>$this->form_validation->error_array());
			}else{
				$recibo = $this->security->xss_clean($this->input->post('pa_recibo'));
				$valor = $this->security->xss_clean($this->input->post('pa_valor'));
				$tipo = $this->security->xss_clean($this->input->post('pa_tipo'));
				$id_factura = $this->security->xss_clean($this->input->post('pa_id_factura'));

				$db_data = array(
					'id_factura' => $id_factura,
					'num_recibo' => $recibo,
					'valor_pago' => $valor,
					'id_tipo_pago' => $tipo,
					'id_user' => 1
				);

				$nuevo_pago = $this->pagos_model->ingresar_pago($db_data);
				if ($nuevo_pago) {
					$data = array("res"=>"success",
								"id"=>$nuevo_pago);
				}
			}
			echo json_encode($data);
		}else{
			$data= array('res' => "error");
		}
	}

}
