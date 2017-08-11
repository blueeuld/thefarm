<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Providers extends TF_Controller {


    public function index()
    {
        $search = \TheFarm\Models\ContactQuery::create();
        $search = $search->useUserQuery()->useGroupQuery()->filterByIncludeInProviderList('y')->endUse()->endUse();

        $search = $search->filterByIsActive(true);

        $contacts = $search->find();
        $contactsArr = [];
        foreach ($contacts as $key => $contact) {
            $contactsArr[$key] = $contact->toArray();
            $contactsArr[$key]['User'] = $contact->getUser()->toArray();
            $contactsArr[$key]['User']['Group'] = $contact->getUser()->getGroup()->toArray();
        }

        $data['contacts'] = $contactsArr;


        $this->load->view('admin/users', $data);
    }
    
    public function order() {
        $data['contacts'] = get_provider_list(false, false, false, $_SESSION['User']['LocationId']);
        $this->load->view('admin/providers/order', $data);
    }
    
    public function update() {
	    
	    foreach ($_POST['order'] as $idx => $contact_id) {
			$this->db->update('users', array('order' => $idx), 'contact_id='.$contact_id);
	    }
	    
	    redirect('backend/providers');
	    
    }
}
