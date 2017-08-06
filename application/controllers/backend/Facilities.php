<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilities extends TF_Controller {


	public function index()
	{
		if (!$this->session->has_userdata('ContactId'))
		{
			redirect('login');
		}

		$data = array();

		$this->db->select('*');
		$this->db->from('facilities');
		
		if (!is_admin()) {
			if (get_current_user_locations()) {
				$locations = get_current_user_locations();
				$locations[] = 0;
				$this->db->where_in('location_id', $locations);
			}
		}

		$data['facilities'] = $this->db->get()->result_array();
		
		$this->load->view('admin/facility/index', $data);
	}
}
