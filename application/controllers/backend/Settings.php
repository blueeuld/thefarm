<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends TF_Controller {
	public function index()
	{
		if (!$this->session->has_userdata('ContactId'))
		{
			redirect('login');
		}
		$this->load->view('admin/settings/index', ['setting' => '']);
	}
	
	public function configuration() {
		
		$site = $this->db->get('sites')->row_array();
		
		$pref = json_decode($site['site_system_preferences'], true);
		
		if ($_POST) {
			
			$new_site_pref = $_POST['preferences'];
			
			$pref = array_merge($pref, $new_site_pref);
			
			$this->db->update('sites', array('site_system_preferences' => json_encode($pref)), array('site_id' => $this->input->get_post('site_id')));
		}
		
		if ($pref['upload_path'] === '') {
			$pref['upload_path'] = realpath(dirname(BASEPATH)) . '/images/avatars/';
		}

		if (!isset($pref['start_time'])) {
			$pref['start_time'] = '';
			$pref['end_time'] = '';
		}
		
		$data['preferences'] = $pref;
		$data['site_id'] = $site['site_id'];
        $data['setting'] = 'configuration';

		$this->load->view('admin/settings/index', $data);
	}

    public function users () {
        $data = array();

        $users = \TheFarm\Models\ContactQuery::create()->useUserQuery()->useGroupQuery()->filterByGroupCd('administrator')->endUse()->endUse()->find();

        $userArr = [];
        foreach ($users as $key => $user) {
            $userArr[$key] = $user->toArray();
        }


        $data['users'] = $userArr;

        $data['setting'] = 'users';

        $this->load->view('admin/settings/index', $data);
    }

    public function category() {

        if (!$this->session->has_userdata('ContactId')) {
            redirect('login');
        }

        $this->db->select('categories.*');
        $this->db->from('categories');
        if ($_SESSION['User']['LocationId']) {
            $location = $_SESSION['User']['LocationId'];
            $this->db->where_in('categories.location_id', array(0, $location));
        }

        $this->db->order_by('categories.parent_id', 'asc');

        $categories = $this->db->get();

        $data = array();
        $data['categories'] = $categories->result_array();

        $data['setting'] = 'category';

        $this->load->view('admin/settings/index', $data);
    }

    public function package_types()
    {
        if (!$this->session->has_userdata('ContactId'))
        {
            redirect('login');
        }

        $this->db->select('package_types.*');
        $this->db->from('package_types');

        $this->db->order_by('package_types.package_type_name', 'asc');

        $categories = $this->db->get();

        $data = array();
        $data['packagetypes'] = $categories->result_array();


        $data['setting'] = 'package_types';

        $this->load->view('admin/settings/index', $data);
    }

    public function groups()
    {
        if (!$this->session->has_userdata('ContactId'))
        {
            redirect('login');
        }

        $data = array();
        $data['groups'] = $this->db->get('groups')->result_array();

        $data['setting'] = 'groups';
        $this->load->view('admin/settings/index', $data);
    }

    public function forms() {

        $data['forms'] = $this->db->get('forms')->result_array();
        $data['fields'] = $this->db->get('fields')->result_array();

        $data['setting'] = 'forms';
        $this->load->view('admin/settings/index', $data);
	}
}
