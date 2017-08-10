<?php

class Guests extends TF_Controller {

    public function index() {
        if (!$this->session->has_userdata('ContactId'))
        {
            redirect('login');
        }

        $search = \TheFarm\Models\ContactQuery::create();
        $search = $search->useUserQuery()->useGroupQuery()->filterByGroupCd('guest')->endUse()->endUse();
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

}