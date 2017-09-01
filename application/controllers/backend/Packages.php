<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends TF_Controller {

    protected $secured = true;

	public function index()
	{

		$data = array();
		$data['packages'] = $this->db->get('packages')->result_array();
		
		$this->load->view('admin/packages/index', $data);
	}
}
