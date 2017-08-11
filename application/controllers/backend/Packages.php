<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends TF_Controller {


	public function index()
	{
		if (!$this->session->has_userdata('ContactId'))
		{
			redirect('login');
		}

		$data = array();
		$data['packages'] = $this->db->get('packages')->result_array();
		
		$this->load->view('admin/packages/index', $data);
	}
}
