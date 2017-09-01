<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends TF_Controller {

    protected $secured = true;

	public function index()
	{
		
		$this->db->distinct();
		$this->db->select('items.*');
		$this->db->from('items');
		$this->db->join('item_categories', 'items.item_id = item_categories.item_id', 'left');
		$this->db->join('categories', 'categories.cat_id = item_categories.category_id', 'left');
		if ($_SESSION['User']['LocationId']) {
			$location = $_SESSION['User']['LocationId'];
			$this->db->where_in('categories.location_id', array(0, $location));
		}

		if ($this->input->get_post('keyword')) {
			$this->db->where("items.title LIKE '%".$this->input->get_post('keyword')."%'");
		}

		if ($this->input->get_post('category')) {
			$this->db->where('categories.cat_id', $this->input->get_post('category'));
			$this->db->or_where('categories.parent_id', $this->input->get_post('category'));
		}

		$this->db->where('is_active', 1);
		
		$this->db->order_by('title', 'asc');

		$services = $this->db->get();

		$data = array();
		$data['services'] = $services->result_array();
		$data['categories'] =  get_category_options_2();


		$this->load->view('admin/service/index', $data);
	}
}
