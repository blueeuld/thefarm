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

    public function schedule($contact_id = null) {

        $week = $this->uri->segment(5);
        if (!$week) $week = date('Y-m-d');

        $userApi = new UserApi();
        $providers = $userApi->get_users(true, $_SESSION['User']['LocationId']);

        $data['providers'] = $providers;

        $data['contact_id'] = $contact_id;

        $data['week'] = $week;

        $query = $this->db->get_where('users', 'contact_id='.(int)$contact_id);

        $result = $query->row_array();

        if ($contact_id) {
            $currentUser = $userApi->get_user($contact_id);
            $workPlanArr = [];
            foreach ($currentUser['UserWorkPlanTimes'] as $workPlan) {
                $workPlanArr[date('Y-m-d', strtotime($workPlan['StartDate']))][] = date('H:i', strtotime($workPlan['StartDate']));
            }
        }

        $params['date'] = $week;
        $params['base'] = 'backend/providers/schedule/'.$contact_id;
        $params['schedule'] = $result['work_plan'] ? unserialize($result['work_plan']) : false;
        $params['schedule_code'] = $result['work_plan_code'] ? unserialize($result['work_plan_code']) : false;

        $this->load->library('weeklycalendar', $params);

        $this->load->view('admin/providers/schedule', $data);
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
