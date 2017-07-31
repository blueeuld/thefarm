<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function users() {

        $userType = $this->uri->segment(3);

        $search = \TheFarm\Models\ContactQuery::create();

        if ($userType && $userType === 'guest') {
            $search = $search->useUserQuery()
                ->filterByGroupId(5)->endUse();
        }

        $users = $search->find();

        foreach ($users as $user) {
            //$user->getUsers();
        }

        $usersArray = $users->toArray();

        $data = [
            'users' => $usersArray
        ];

//        var_dump($data);

        $this->load->view('users', $data);
    }

}