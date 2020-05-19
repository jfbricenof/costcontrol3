<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function index(){
		$this->mytemplate->loadAdmin('admin/panel');
	}
}
