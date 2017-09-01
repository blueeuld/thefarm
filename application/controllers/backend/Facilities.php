<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facilities extends TF_Controller {

    protected $secured = true;

	public function index()
	{

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
