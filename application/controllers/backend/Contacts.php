<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends TF_Controller {
	
	private $view = 'guest';
	
	public function guest() {
		$this->view = 'guest';
		$this->index();
	}
	
	public function provider() {
		$this->view = 'provider';
		$this->index();
	}
	
	public function json() {
		        
        $this->db->select('contacts.*');
        $this->db->join('users', 'contacts.contact_id = users.contact_id', 'left');
        $this->db->join('groups', 'users.group_id = groups.group_id', 'left');

        if ($keyword = $this->input->get_post('keyword')) {
            $this->db->where("(
                first_name LIKE '%$keyword%' OR 
                last_name LIKE '%$keyword%' OR 
                email LIKE '%$keyword%' OR 
                CONCAT(first_name, ' ', last_name) LIKE '%$keyword%' OR 
                CONCAT(last_name, ' ', first_name) LIKE '%$keyword%')");
        }

        if ($this->view === 'guest')  {
	        $this->db->where('(users.group_id = 5 OR users.group_id IS NULL)');
	    }
	    elseif ($this->view === 'provider') {
	        $this->db->where('groups.include_in_provider_list', 'y');
	    }

        $this->db->where('contacts.is_active = 0');
        $this->db->order_by('contacts.first_name', 'ASC');        
		$result = $this->db->get('contacts')->result_array();
		
/*
		$output = array();
		
		foreach ($result as $row) {
			$output[] = $row['first_name'] . ' '  . $row['last_name'];
		}
*/
		
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

    public function index()
    {
        if (!$this->session->has_userdata('ContactId'))
        {
            redirect('login');
        }

        $search = \TheFarm\Models\ContactQuery::create();
        if ($this->view === 'guest') {
            $search = $search->useUserQuery()->useGroupQuery()->filterByGroupCd('guest')->endUse()->endUse();
        }
        elseif ($this->view === 'provider') {
            $search = $search->useUserQuery()->useGroupQuery()->filterByIncludeInProviderList('y')->endUse()->endUse();
        }

        $search = $search->filterByIsActive(true);

        $contacts = $search->find();
        $contactsArr = [];
        foreach ($contacts as $key => $contact) {
            $contactsArr[$key] = $contact->toArray();
            $contactsArr[$key]['User'] = $contact->getUser()->toArray();
            $contactsArr[$key]['User']['Group'] = $contact->getUser()->getGroup()->toArray();
        }

        $data['contacts'] = $contactsArr;

        $data['view'] = $this->view;

        $this->load->view('admin/contacts/index', $data);
    }
}
