<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina_404 extends CI_Controller {

	public function index(){
		$this->mytemplate->loadAdmin('admin/Pagina_404');
	}
}
