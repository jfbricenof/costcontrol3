<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_general extends CI_Controller {

	public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('login')) {
            redirect(base_url());
        }
        $this->load->model('admin/config_general_model');
    }

	public function index(){
		$info_empresa = $this->config_general_model->get_info_empresa();
		$data['info'] = $info_empresa;
		$this->mytemplate->loadAdmin('admin/config_general', $data);
	}

	public function actualizar_empresa(){
		// primero validar
		if ($this->input->is_ajax_request()){

			$this->form_validation->set_rules('nombre_empresa','Nombre','trim|required|max_length[30]');
			$this->form_validation->set_rules('nit_empresa','Nit','trim|required|max_length[20]');
			$this->form_validation->set_rules('dir_empresa','Dirección','trim|required|max_length[60]');
			$this->form_validation->set_rules('ciudad_empresa','Ciudad','trim|required|max_length[20]');
			$this->form_validation->set_rules('dep_empresa','Departamento','trim|required|max_length[60]');
			$this->form_validation->set_rules('tel_fijo_empresa','Teléfono','trim|numeric|max_length[12]');
			$this->form_validation->set_rules('web_empresa','Web','trim|required|max_length[40]');
			$this->form_validation->set_rules('confirmar','Confirmar','required');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{
				$db_data = array(
					'nit' => $this->security->xss_clean($this->input->post('nit_empresa')),
					'nombre' => $this->security->xss_clean($this->input->post('nombre_empresa')),
					'departamento' => $this->security->xss_clean($this->input->post('dep_empresa')),
					'ciudad' => $this->security->xss_clean($this->input->post('ciudad_empresa')),
					'direccion' => $this->security->xss_clean($this->input->post('dir_empresa')),
					'telefono' => $this->security->xss_clean($this->input->post('tel_fijo_empresa')),
					'web' => $this->security->xss_clean($this->input->post('web_empresa'))
				);

				$edit_empresa = $this->config_general_model->update_empresa($db_data);

				if($edit_empresa){
					$data = array("res"=>"success");
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{
			// ajax error
		}
	}

	public function add_tipo_inmueble(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('nom_tinmueble','Nombre del Tipo de Inmueble','trim|required|max_length[30]');
			$this->form_validation->set_rules('descrip_tinmueble','Descripción Tipo de Inmueble','trim|required|max_length[140]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$nom_tinmueble = $this->security->xss_clean($this->input->post('nom_tinmueble'));
				$descrip_tinmueble = $this->security->xss_clean($this->input->post('descrip_tinmueble'));

				$db_data = array(
					'id_empresa' => $this->session->userdata('empresa')->id_empresa,
					'nombre' => $nom_tinmueble,
					'descripcion' => $descrip_tinmueble,
					'estado' => 1, // inicia activo
					'id_user' => $this->session->userdata('id_user')
				);

				$insert_tipo_inmueble = $this->config_inmueble_model->insert_tipo_inmueble($db_data);

				if($insert_tipo_inmueble){

					$ruta_edit = base_url().'admin/config_inmuebles/edit_tipo_inmueble/'.$insert_tipo_inmueble;
					$ruta_del = base_url().'admin/config_inmuebles/borrar_tipo_inmueble/'.$insert_tipo_inmueble;

					$data = array(
								"res"=>"success",
								"ruta_edit"=>$ruta_edit,
								"ruta_del"=>$ruta_del,
								"nombre"=>$nom_tinmueble,
								"descripcion"=>$descrip_tinmueble
								);
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{

		}
	}

	public function borrar_tipo_inmueble($id_tipo){
		$del_tipo_inmueble = $this->config_inmueble_model->delete_tipo_inmueble($id_tipo);
		if($del_tipo_inmueble){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_tipo_inmueble($id_tipo){
		if ($this->input->is_ajax_request()){

			$this->form_validation->set_rules('edit_nom_tinmueble','Nombre del Tipo de Inmueble','trim|required|max_length[30]');
			$this->form_validation->set_rules('edit_descrip_tinmueble','Descripción Tipo de Inmueble','trim|required|max_length[140]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$nom_tinmueble = $this->security->xss_clean($this->input->post('edit_nom_tinmueble'));
				$descrip_tinmueble = $this->security->xss_clean($this->input->post('edit_descrip_tinmueble'));

				$db_data = array(
					'nombre' => $nom_tinmueble,
					'descripcion' => $descrip_tinmueble,
					'id_user' => $this->session->userdata('id_user')
				);

				$update_tipo_inmueble = $this->config_inmueble_model->update_tipo_inmueble($id_tipo,$db_data);

				if($update_tipo_inmueble){
					$data = array(
								"res"=>"success",
								"nombre"=>$nom_tinmueble,
								"descripcion"=>$descrip_tinmueble
								);
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{

		}
	}

	public function add_sector(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('nom_sector','Nombre del Sector','trim|required|max_length[30]');
			$this->form_validation->set_rules('descrip_sector','Descripción del Sector','trim|required|max_length[140]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$nom_sector = $this->security->xss_clean($this->input->post('nom_sector'));
				$descrip_sector = $this->security->xss_clean($this->input->post('descrip_sector'));

				$db_data = array(
					'id_empresa' => $this->session->userdata('empresa')->id_empresa,
					'nombre' => $nom_sector,
					'descripcion' => $descrip_sector,
					'estado' => 1, // inicia activo
					'id_user' => $this->session->userdata('id_user')
				);

				$insert_sector = $this->config_inmueble_model->insert_sector($db_data);

				if($insert_sector){

					$ruta_edit = base_url().'admin/config_inmuebles/edit_sector/'.$insert_sector;
					$ruta_del = base_url().'admin/config_inmuebles/borrar_sector/'.$insert_sector;

					$data = array(
								"res"=>"success",
								"ruta_edit"=>$ruta_edit,
								"ruta_del"=>$ruta_del,
								"nombre"=>$nom_sector,
								"descripcion"=>$descrip_sector
								);
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{

		}
	}

	public function borrar_sector($id_sector){
		$del_sector = $this->config_inmueble_model->delete_sector($id_sector);
		if($del_sector){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_sector($id_sector){
		if ($this->input->is_ajax_request()){

			$this->form_validation->set_rules('edit_nom_sector','Nombre del Sector','trim|required|max_length[30]');
			$this->form_validation->set_rules('edit_descrip_sector','Descripción del Sector','trim|required|max_length[140]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$nom_sector = $this->security->xss_clean($this->input->post('edit_nom_sector'));
				$descrip_sector = $this->security->xss_clean($this->input->post('edit_descrip_sector'));

				$db_data = array(
					'nombre' => $nom_sector,
					'descripcion' => $descrip_sector,
					'id_user' => $this->session->userdata('id_user')
				);

				$update_sector = $this->config_inmueble_model->update_sector($id_sector,$db_data);

				if($update_sector){
					$data = array(
								"res"=>"success",
								"nombre"=>$nom_sector,
								"descripcion"=>$descrip_sector
								);
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{

		}
	}

	public function add_servicio(){
		if ($this->input->is_ajax_request()){
			$this->form_validation->set_rules('nom_servicio','Nombre del Servicio','trim|required|max_length[30]');
			$this->form_validation->set_rules('descrip_servicio','Descripción del Servicio','trim|required|max_length[140]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$nom_servicio = $this->security->xss_clean($this->input->post('nom_servicio'));
				$descrip_servicio = $this->security->xss_clean($this->input->post('descrip_servicio'));

				$db_data = array(
					'id_empresa' => $this->session->userdata('empresa')->id_empresa,
					'nombre' => $nom_servicio,
					'descripcion' => $descrip_servicio,
					'estado' => 1, // inicia activo
					'id_user' => $this->session->userdata('id_user')
				);

				$insert_servicio = $this->config_inmueble_model->insert_servicio($db_data);

				if($insert_servicio){

					$ruta_edit = base_url().'admin/config_inmuebles/edit_servicio/'.$insert_servicio;
					$ruta_del = base_url().'admin/config_inmuebles/borrar_servicio/'.$insert_servicio;

					$data = array(
								"res"=>"success",
								"ruta_edit"=>$ruta_edit,
								"ruta_del"=>$ruta_del,
								"nombre"=>$nom_servicio,
								"descripcion"=>$descrip_servicio
								);
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{

		}
	}

	public function borrar_servicio($id_servicio){
		$del_servicio = $this->config_inmueble_model->delete_servicio($id_servicio);
		if($del_servicio){
			$data = array("res"=>"success");
		}else{
			$data = array("res"=>"error");
		}
		echo json_encode($data);
	}

	public function edit_servicio($id_servicio){
		if ($this->input->is_ajax_request()){

			$this->form_validation->set_rules('edit_nom_servicio','Nombre del Servicio','trim|required|max_length[30]');
			$this->form_validation->set_rules('edit_descrip_servicio','Descripción del Servicio','trim|required|max_length[140]');

			if (!$this->form_validation->run()) {
				$data = array('res'=>'error','errors'=>$this->form_validation->error_array());
			}else{

				$nom_servicio = $this->security->xss_clean($this->input->post('edit_nom_servicio'));
				$descrip_servicio = $this->security->xss_clean($this->input->post('edit_descrip_servicio'));

				$db_data = array(
					'nombre' => $nom_servicio,
					'descripcion' => $descrip_servicio,
					'id_user' => $this->session->userdata('id_user')
				);

				$update_servicio = $this->config_inmueble_model->update_servicio($id_servicio,$db_data);

				if($update_servicio){
					$data = array(
								"res"=>"success",
								"nombre"=>$nom_servicio,
								"descripcion"=>$descrip_servicio
								);
				}else{
					$data = array("res"=>"error");
				}
			}
			echo json_encode($data);
		}else{

		}
	}

} // end class
