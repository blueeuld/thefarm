<?php

class Provider extends TF_Controller {


    public function edit($guestId) {

        if (!current_user_can('CanViewOtherProfiles') && get_current_user_id() !== $guestId && is_guest()) {
            show_error('Page Not Found!');
        }

        $userApi = new UserApi();

        $userData = $userApi->get_user($guestId);

        $data['statuses'] = get_booking_statuses();

        print_r($userData['UserWorkPlanTimes']);



        /*
        $data['related_services'] = $related_services;

        $other_services = get_services(false, $exclude);
        $other = array();
        foreach ($other_services as $service) {
            $duration = (int)$service['duration'];
            $other[$service['cat_name']][$service['item_id']] = $service['title'] . ($duration > 0 ? ' ('.$duration . ' min)' : '');
        }

        $data['other_services'] = $other;

        $q = $this->db->get_where('messages', array('receiver' => $contact_id));
        $data['messages'] = $q->result_array();

        $start_date = time();
        $end_date = time();
        $number_of_days = 1;
        $booking_id = 0;
        $view = '';
        if ($confirmed_bookings) {
            $booking = $confirmed_bookings[0];
            $booking_id = (int)$booking['booking_id'];
            $start_date = $booking['start_date'];
            $end_date = $booking['end_date'];
            $start_date_dt = new DateTime(date('c', $start_date));
            $end_date_dt = new DateTime(date('c', $end_date));
            $diff = $start_date_dt->diff($end_date_dt);
            $number_of_days = (int)$diff->days;
            $view = $number_of_days > 0 ? 'agenda' . ($number_of_days+1) . 'Days' : 'agendaWeek';
        }

        $data['booking_id'] = $booking_id;

        $this->db->select('booking_events.*, items.description, facilities.bg_color, items.title as item_name, items.duration, facilities.facility_name, contacts.first_name, contacts.last_name, contacts.nickname');
        $this->db->from('booking_events');
        $this->db->join('items', 'items.item_id = booking_events.item_id');
        $this->db->join('item_categories', 'items.item_id = item_categories.item_id');
        $this->db->join('facilities', 'facilities.facility_id = booking_events.facility_id', 'left');
        $this->db->join('booking_event_users', 'booking_events.event_id = booking_event_users.event_id', 'left');
        $this->db->join('contacts', 'contacts.contact_id = booking_event_users.staff_id', 'left');
        $this->db->where_in('item_categories.category_id', array(4, 9));
        $this->db->where('booking_events.is_active', 'n');
        $this->db->order_by('booking_events.start_dt', 'asc');
        $results = $this->db->get();
        $data['activities'] = $results->result_array();

        $categories = array(1,2,3,12); //get_category_options_2('&nbsp;');

        $data['categories'] = array(); //$categories;

        $locations = array();
        foreach (get_locations() as $location_id => $location_name) {
            if (current_user_can('CanViewSchedules' . $location_id)) {
                $locations[] = (int)$location_id;
            }
        }

        $view_name = 'agenda'.($number_of_days+1).'Days';

        $inline_js = array(
            'showGuestName' => false,
            'showFacility' => true,
            'abbreviate' => true,
            'resource_field_id' => 'contact_id',
            'businessHours' => false,
            'defaultView' => 'month',
            'start_date' => date('Y-m-d'),
            'minTime' => site_pref('start_time'),
            'maxTime' => site_pref('end_time'),
            'booking_id' => $booking_id,
            'droppable' => true,
            'show_providers' => true,
            'header' => array(
                'left' => 'prev, next, today, treatments, nutritionals',
                'center' => 'title',
                'right' => 'month,'.$view_name,
            ),
            'guest_name' => $data['account']['title'] . '. '.$data['account']['first_name'] . ' ' . $data['account']['last_name'],
            'views' => array(
                $view_name => array(
                    'type' => 'agenda',
                    'duration' => array('days' => $number_of_days + 1),
                    'start_date' => date('c', $start_date),
                    'buttonText' => ($number_of_days+1) . ' day(s)')
            ),
            'categories' => array(1, 2, 3, 12),
            'viewFullDetails' => true, //!tf_current_user_can('edit_calendar'),
            'canChange' => current_user_can('CanAddSchedule'),
            'user_id' => $_SESSION['ContactId'],
            'show_providers' => false,
        );
        */
        $inline_js = [];
        $data['inline_js'] =  $inline_js; /*array(
			'print_url' => site_url('backend/account/print_schedule'),
			'positions' => array(),
			'showGuestName' => false,
			'showFacility' => false,
			'abbreviate' => false,
			'editable' => true,
			'resource_field_id' => '',
			'businessHours' => false,
			'defaultView' => 'month',
			'start_date' => date('Y-m-d', $start_date),
			'end_date' => date('Y-m-d', $end_date),
			'minTime' => site_pref('start_time'),
			'maxTime' => site_pref('end_time'),
			'droppable' => true,
			'show_providers' => false,

			'guest_name' => $data['account']['title'] . '. '.$data['account']['first_name'] . ' ' . $data['account']['last_name'],
			'viewFullDetails' => true, //!tf_current_user_can('edit_calendar'),
			'canChange' => true,
			'statuses' => array(),
			'user_id' => $_SESSION['ContactId'],
			'selected_locations' => $locations,
			'booking_id' => $booking_id,
			'categories' => $categories,
		);*/

        if ($this->input->get_post('back')) {
            $data['back'] = $this->input->get_post('back');
        }
        else {
            $data['back'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url('contacts');
        }



        /*

        $data['editable'] = $editable;
        $data['return'] = $this->input->get_post('return') ? $this->input->get_post('return') : 'contacts';
        $data['booking_items'] = booking_items($data['booking_id'], 'confirmed', true);
        if (is_guest()) {
            $this->load->library('FormBuilder');
            if ($booking_id > 0) {
                $data['booking'] = $booking;
                $data['forms'] = booking_forms($booking_id, 'n');
            }
            else {
                $data['forms'] = false;
                $data['booking'] = false;
            }
            $this->load->view('admin/account/guest', $data);
        }
        else {

            $this->load->library('FormBuilder');

            $this->db->select('contacts.*, forms.*, bookings.*, booking_forms.*');
            $this->db->from('booking_forms');
            $this->db->join('bookings', 'booking_forms.booking_id = bookings.booking_id');
            $this->db->join('forms', 'booking_forms.form_id = forms.form_id');
            $this->db->join('contacts', 'booking_forms.completed_by = contacts.contact_id', 'left');
            $this->db->where('bookings.guest_id', $contact_id);
            $this->db->where('bookings.is_active', 1);
            $query = $this->db->get();

            $data['guest_forms'] = $query->result_array();
            $data['work_plan'] = isset($data['account']['work_plan']) ? unserialize($data['account']['work_plan']) : '';
            $this->load->view('admin/user_form', $data);
        }
        */

        $data['userData'] = $userData;

        $this->load->view('admin/user_form', $data);
    }

    public function save() {

        $return = $this->input->get_post('return');
        $contact_id = $this->input->get_post('contact_id');

        $data = array(
            'ContactId' => $contact_id,
            'FirstName' => $this->input->get_post('first_name'),
            'LastName' => $this->input->get_post('last_name'),
            'Title' =>  $this->input->get_post('title'),
            'Eemail' =>  $this->input->get_post('email'),
            'CivilStatus' => $this->input->get_post('civil_status'),
            'Nationality' => $this->input->get_post('nationality'),
            'CountryDominicile' => $this->input->get_post('country_dominicile'),
            'EtnicOrigin' => $this->input->get_post('etnic_origin'),
            'Dob' => date('Y-m-d', strtotime($this->input->get_post('dob'))),
            'Gender' => $this->input->get_post('gender'),
            'Height' => $this->input->get_post('height'),
            'Weight' => $this->input->get_post('weight'),
            'Phone' => $this->input->get_post('phone'),
            'Nickname' => $this->input->get_post('nickname'),
            'PositionCd' => $this->input->get_post('position') ? $this->input->get_post('position') : null,
            'DateJoined' => date('Y-m-d', strtotime($this->input->get_post('date_joined'))),
        );

        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name','First name','required');
        $this->form_validation->set_rules('last_name','Last name','required');

        if($this->form_validation->run()==TRUE){

            $config = get_upload_config(1);

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('avatar')) {
                $file = $this->upload->data();
                $data['avatar'] = $config['url'].'/'.$file['file_name'];
            }
            else {
                $this->session->set_flashdata('error_message', $this->upload->display_errors('', ''));
            }

            if (!$contact_id) {
                $key = hash('md5', time());
                $data['VerificationKey'] = $key;
            }

            $userApi = new UserApi();
            $savedUser = $userApi->save_user($data);

            if (!isset($_REQUEST['skip_confirmation']) && !empty($savedUser['Email'])) {
                $this->load->library('email');

                $this->email->from($_SESSION['Email'],  $_SESSION['FirstName']);
                $this->email->to($savedUser['Email']);


                $this->email->subject('Verify your TheFarm account');
                $this->email->message(
                    'Hi '.$savedUser['First_name'].' ' .$savedUser['LastName'].", \n\n\n".
                    'Welcome to TheFarm! '."\n\n".
                    'Please complete your account by verifying your email address.'."\n\n".
                    '<a href="'.site_url('register/verify/'.$savedUser['ContactId'].'/'.$savedUser['VerificationKey']).'">VERIFY EMAIL</a>'."\n\n".
                    'If the link above doesn\'t work, you can copy and paste the following into your browser:'."\n".
                    site_url('register/verify/'.$savedUser['ContactId'].'/'.$savedUser['VerificationKey'])
                );

                $this->email->send();
            }


            $this->session->set_flashdata('success_message', 'Profile has been successfully saved.');

            redirect('backend/guest/edit/'.$savedUser['ContactId'].'?return='.$return);
        }else{
            echo "Missing field required.Please try again";
        }
    }


}