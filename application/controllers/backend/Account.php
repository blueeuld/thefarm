<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends TF_Controller {

    public function index()
    {
        if (!$this->session->has_userdata('ContactId'))
        {
            redirect('login');
        }

        if (!$_POST) return;

		$return = $this->input->get_post('return');
        $contact_id = $this->input->get_post('contact_id');
        $data = array(
            'first_name' => $this->input->get_post('first_name'),
            'last_name' => $this->input->get_post('last_name'),
            'title' =>  $this->input->get_post('title'),
            'email' =>  $this->input->get_post('email'),
            'civil_status' => $this->input->get_post('civil_status'),
            'nationality' => $this->input->get_post('nationality'),
            'country_dominicile' => $this->input->get_post('country_dominicile'),
            'etnic_origin' => $this->input->get_post('etnic_origin'),
            'dob' => date('Y-m-d', strtotime($this->input->get_post('dob'))),
            'age' => $this->input->get_post('age'),
            'gender' => $this->input->get_post('gender'),
            'height' => $this->input->get_post('height'),
            'weight' => $this->input->get_post('weight'),
            'phone' => $this->input->get_post('phone'),
            'nickname' => $this->input->get_post('nickname'),
            'position_cd' => $this->input->get_post('position') ? $this->input->get_post('position') : null,
            'date_joined' => date('Y-m-d', strtotime($this->input->get_post('date_joined'))),
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

            if ($contact_id) {
                $this->db->update('contacts', $data, array('contact_id' => $contact_id));
            }
            else {

                $key = hash('md5', time());
                $data['verification_key'] = $key;

                $this->db->insert('contacts', $data);
                $contact_id = $this->db->insert_id();


                if (!isset($_REQUEST['skip_confirmation']) && !empty($data['email'])) {
                    $this->load->library('email');

                    $this->email->from($_SESSION['Email'],  $_SESSION['FirstName']);
                    $this->email->to($data['email']);


                    $this->email->subject('Verify your TheFarm account');
                    $this->email->message(
                        'Hi '.$data['first_name'].' ' .$data['last_name'].", \n\n\n".
                        'Welcome to TheFarm! '."\n\n".
                        'Please complete your account by verifying your email address.'."\n\n".
                        '<a href="'.site_url('register/verify/'.$contact_id.'/'.$key).'">VERIFY EMAIL</a>'."\n\n".
                        'If the link above doesn\'t work, you can copy and paste the following into your browser:'."\n".
                        site_url('register/verify/'.$contact_id.'/'.$key)
                    );

                    $this->email->send();
                }
            }

            $this->session->set_flashdata('success_message', 'Profile has been successfully saved.');

            redirect('backend/account/edit/'.$contact_id.'?return='.$return);
        }else{
            echo "Missing field required.Please try again";
        }
    }



    public function edit() {

        if ($this->uri->segment(4) === FALSE)
        {
            $contact_id = 0;
        }
        else
        {
            $contact_id = (int)$this->uri->segment(4);
        }

        if (!current_user_can('CanViewOtherProfiles') && get_current_user_id() !== $contact_id && is_guest()) {
            show_error('Page Not Found!');
        }

        $booking_id = $this->uri->segment(4);

        $data = array();
        $data['contact_id'] = $contact_id;
        $data['booking_id'] = $booking_id;

        $inner_s = "SELECT bookings.booking_id 
                    FROM tf_bookings bookings 
                    WHERE bookings.guest_id = tf_contacts.contact_id AND bookings.status = 'confirmed' AND is_active=1 ";

        $inner_s .= 'LIMIT 1';

        $this->db->select('users.*, contacts.*, groups.include_in_provider_list, ('.$inner_s.') as recent_booking');
        $this->db->from('contacts');
        $this->db->join('users', 'users.contact_id = contacts.contact_id', 'left');
        $this->db->join('groups', 'users.group_id = groups.group_id', 'left');
        $this->db->where('contacts.contact_id = ', $contact_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data['account'] = $query->row_array();
        }
        else {
            $data['account'] = array(
                'first_name' => '',
                'last_name' => '',
                'dob' => '',
                'age' => '',
                'gender' => '',
                'date_joined' => date('Y-m-d', now()),
                'nationality' => 'Filipino',
                'country_dominicile' => 'PH',
                'username' => '',
                'avatar' => '',
                'etnic_origin' => '',
                'civil_status' => '',
                'height' => '',
                'weight' => '',
                'phone' => '',
                'email' => '',
                'title' => '',
                'position_cd' => null, //edited
                'recent_booking' => 0,
                'group_id' => 5, //Guest,
                'work_plan' => '',
                'last_login' => 0,
                'contact_id' => 0,
                'nickname' => '',
                'include_in_provider_list' => 'n'
            );
        }
        
        $data['titles'] = array(
        'Ms' => 'Ms',
		'Mrs' => 'Mrs',
		'Mr' => 'Mr',
		'Master' => 'Master',
		'Rev' => 'Rev',
		'Fr' => 'Fr',
		'Dr' => 'Dr',
		'Atty' => 'Atty',
		'Prof' => 'Prof',
		'Hon' => 'Hon',
		'Pres' => 'Pres',
		'Gov' => 'Gov',
		'Coach' => 'Coach',
		'Ofc' => 'Ofc',
		'Rep' => 'Rep',
		'Sen' => 'Sen');
		
		$data['civil_statuses'] = array(
		'Single' => 'Single',
		'Married' => 'Married',
		'Living Common Law' => 'Living Common Law',
		'Widowed' => 'Widowed',
		'Separated' => 'Separated',
		'Divorced' => 'Divorced',
		);

        $data['group_id'] = $data['account']['group_id'];

        $data['bookings'] = get_bookings($contact_id);

        $confirmed_bookings = get_bookings($contact_id, 'confirmed');

        $data['confirmed_bookings'] = $confirmed_bookings;

        $data['statuses'] = get_booking_statuses();

        $data['nationality'] = $data['account']['nationality'] === '' ? 'Filipino' : $data['account']['nationality'];

        $data['nationalities'] = nationalities();

        $data['countries'] = countries();

        $positions = ['' => ''];

        $this->db->select('*');
        $this->db->from('position');
        $query = $this->db->get();
        if ($query->num_rows()) {
            $results = $query->result_array();
            foreach ($results as $row) {
                $positions[$row['position_cd']] = $row['position_value'];
            }
        }

        $data['positions'] = $positions;

        $this->db->select('items.*, items_related_users.contact_id');
        $this->db->from('items');
        $this->db->join('items_related_users', 'items.item_id = items_related_users.item_id', 'left');
        $this->db->where('contact_id = '.$contact_id);
        $q = $this->db->get();

        $related_services = array();
        $exclude = array();
        if ($q->num_rows()) {
            $related_services = $q->result_array();
            foreach ($related_services as $service) {
                $exclude[] = $service['item_id'];
            }
        }

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
			
		$editable = false;
		
		if ($_SESSION['ContactId'] === $data['account']['group_id']) {
			$editable = true;
		}
		elseif (current_user_can('CanEditOtherProfiles')) {
			$editable = true;
		}
		
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
            $this->load->view('admin/account/form', $data);
        }
    }

    public function calendar() {
        $this->load->view('admin/account/calendar-popup');
    }



    public function save()
    {

    }

    public function register() {

    }

    public function check_name() {

        $resultArr = [
            'IsExisting' => false,
            'Guest' => null,
        ];

        $search = \TheFarm\Models\ContactQuery::create()
            ->filterByFirstName($this->input->get_post('first_name'))
            ->filterByLastName($this->input->get_post('last_name'))->findOne();

        if ($search) {

            $resultArr['IsExisting'] = true;
            $resultArr['Guest'] = $search->toArray();
            $resultArr['Guest']['ConfirmedBooking'] = [];

            $bookingSearch = \TheFarm\Models\BookingQuery::create()->
                filterByGuestId($search->getContactId())->filterByStatus('confirmed')->
                filterByIsActive(true)
                ->findOne();

            if ($bookingSearch) {
                $resultArr['Guest']['ActiveBooking'] = $bookingSearch->toArray();
            }

        }
        $this->output->set_content_type('application/json')->set_output(json_encode($resultArr));
    }

    public function error(){
        $this->view('admin/account', array('error'=>'required'));
    }

    public function login() {
        $contact_id = $this->input->get_post('contact_id');
        $return = $this->input->get_post('return');
        $query = $this->db->get_where('users',
            array(
                'username' => $this->input->get_post('username'),
                'contact_id != ' => $contact_id)
        );


        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('error_message', 'Username already exists.');
            redirect('backend/account/edit/'.$contact_id);
        }
        else {

            $data = array();

            if ($this->input->get_post('password') &&
                $this->input->get_post('password') === $this->input->get_post('confirm_password')) {
                $data['password'] = do_hash($this->input->get_post('password'));
            }

            if (is_admin() && $group_id = $this->input->get_post('group_id')) {
                $data['group_id'] = $group_id;
            }

            if (is_admin() && $location_id = $this->input->get_post('location_id')) {
                $data['location_id'] = $location_id;
            }

            if ($this->input->get_post('new_password') &&
                $this->input->get_post('new_password') === $this->input->get_post('confirm_new_password')) {
                $data['password'] = do_hash($this->input->get_post('new_password'));
            }

            $data['username'] = $this->input->get_post('username');

            $query = $this->db->get_where('users', array('contact_id' => $contact_id));
            if ($query->num_rows() > 0)
                $this->db->update('users', $data,
                    array('contact_id' => $contact_id));
            else {

                $data['username'] = $this->input->get_post('username');
                $data['contact_id'] = $contact_id;

                $this->db->insert('users', $data);
            }
            redirect('backend/account/edit/'.$contact_id.'?return='.$return);
        }
    }

    public function delete() {

        $id = (int)$this->uri->segment(4);
        $confirm = $this->input->get_post('confirm');
        
        if ($id && $confirm && $confirm === 'y') {

            $userApi = new UserApi();
            $userApi->delete_user($id);

            if ($return = $this->input->get_post('return'))
                redirect($return);
        }

        redirect('backend/contacts');
    }

    public function dashboard() {
	    $this->db->select('booking_events.*, items.description, facilities.bg_color, items.title as item_name, items.duration, facilities.facility_name, contacts.first_name, contacts.last_name, contacts.nickname');
        $this->db->from('booking_events');
        $this->db->join('items', 'items.item_id = booking_events.item_id');
        $this->db->join('item_categories', 'items.item_id = item_categories.item_id');
        $this->db->join('facilities', 'facilities.facility_id = booking_events.facility_id', 'left');
        $this->db->join('booking_event_users', 'booking_events.event_id = booking_event_users.event_id', 'left');
        $this->db->join('contacts', 'contacts.contact_id = booking_event_users.staff_id', 'left');
        $this->db->where_in('item_categories.category_id', array(4, 9));
        $this->db->where('booking_events.is_active', 'n');
		$this->db->order_by('booking_events.start_dt', 'desc');
		$results = $this->db->get();
        $data['activities'] = $results->result_array();
        
        $params = array();
        $params['guest_id'] = get_current_user_id();
        $this->load->library('Eventsbuilder', $params);
		$this->eventsbuilder->build();
		
		
		$data['inline_js'] = array(
            'resources' => array(),
            'view' => 'agendaDay',
            'show_providers' => false,
            'editable' => false,
            'resource_field_id' => 'contact_id',
            'businessHours' => false,
            'defaultView' => 'agendaDay',
            'start_date' => date('Y-m-d'),
            'minTime' => site_pref('start_time'),
            'maxTime' => site_pref('end_time'),
            'showGuestName' => false,
			'showFacility' => false,
			'abbreviate' => false,
            'droppable' => false,
            'header' => array(
                'left' => 'prev, next, today',
                'center' => 'title',
                'right' => 'agendaDay, agendaWeek, month',
            ),
            'views' => array(),
            'guest_id' => get_current_user_id(),
            'show_my_appointments' => true,
            'show_off_providers' => false,
            'viewFullDetails' => true, //!tf_current_user_can('edit_calendar'),
            'canChange' => false,
            'statuses' => array(),
            'selected_statuses' => array(),
            'selected_positions' => array(),
        );
        
        $data['events'] = $this->eventsbuilder->get_events(); // get_events(false, false, 'contact_id', '', '', get_current_user_id(), array(2), array(2));
        $this->load->view('dashboard', $data);
    }

    public function sort() {
        $action = $this->uri->segment(4); //up or down
        $contact_id = (int)$this->uri->segment(4);
        $order = (int)$this->uri->segment(5);

        if ($action === 'up') {
            $order++;
        }
        else {
            $order--;
        }

        $this->db->query('UPDATE tf_users SET `order` = `order` + 1 WHERE contact_id = '.$contact_id);

        $this->load->library('user_agent');
        if ($this->agent->is_referral())
        {
            echo $this->agent->referrer();
        }
    }

    public function add() {
        $group_id = $this->uri->segment(4);

        if ($group_id !== 5) {
            $this->load->view('admin/user/form');
        }
    }
    
    public function user() {

        if (!$_POST) return;

        $group_id = $this->input->get_post('group_id');
        $first_name = $this->input->get_post('first_name');
        $last_name = $this->input->get_post('last_name');
        $email = $this->input->get_post('email');
        $username = $this->input->get_post('username');
        $location_id = $this->input->get_post('location_id');


        $query = $this->db->get_where('users', array('username' => $username));
        if ($query->num_rows() >= 1) {
            show_error('Username already exist!');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('first_name','First name','required');
        $this->form_validation->set_rules('last_name','Last name','required');
        $this->form_validation->set_rules('email','Email','required');

        if($this->form_validation->run()==TRUE) {

            $this->db->insert('contacts', array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'verified' => 'y',
                'date_joined' => date('Y-m-d')
            ));
            $contact_id = $this->db->insert_id();

            $this->db->insert('users', array(
                'contact_id' => $contact_id,
                'username' => $username,
                'group_id' => $group_id,
                'location_id' => $location_id,
            ));

            if (!isset($_REQUEST['skip_confirmation'])) {
                $this->load->library('email');

                $this->email->from($_SESSION['Email'],  $_SESSION['FirstName']);
                $this->email->to($email);

                $message = sprintf(
                    '%s'.":\n\n".
                    'You have been added by %s.'."\n\n".
                    'To view your list of assignments, login to your TheFarm account:'."\n\n".
                    '%s'."\n\n",
                    $first_name, $_SESSION['FirstName'], site_url());

                $user_group = get_user_group($group_id);

                $this->email->subject($_SESSION['FirstName'].' has added you as '.$user_group['group_name']);
                $this->email->message($message);
                $this->email->send();
            }

            redirect('backend/account/edit/'.$contact_id);

        }
    }
    
    public function activate() {
	    $contact_id = (int)$this->input->get_post('contact_id');
	    $status = $this->input->get_post('status');
	    
	    $query = $this->db->get_where('contacts', array('contact_id' => $contact_id));
	    
	    if ($query->num_rows() > 0) {
		    $data = $query->row_array();
	    	$this->db->update('contacts', array('active' => $status), array('contact_id' => $contact_id));
	    	
	    	$text = 'DEACTIVATED';
		    
		    if ($status === 'y') $text = 'ACTIVATED';
		    
	    	$this->output->set_content_type('application/json');
	        echo json_encode(array('message' => $data['first_name'] . ' ' . $data['last_name'] . ' was <b>'.$text.'</b>.'));
	        die();
	    }   
    }
    
    public function verify() {
	    $contact_id = (int)$this->input->get_post('contact_id');
	    $status = $this->input->get_post('status');
	    
	    $query = $this->db->get_where('contacts', array('contact_id' => $contact_id));
	    
	    if ($query->num_rows() > 0) {
		    $data = $query->row_array();
		    $text = 'UNVERIFIED';
		    
		    if ($status === 'y') $text = 'VERIFIED';
		    
		    $data = $query->row_array();
	    	$this->db->update('contacts', array('verified' => $status), array('contact_id' => $contact_id));
	    	
	    	$this->output->set_content_type('application/json');
	        echo json_encode(array('message' => $data['first_name'] . ' ' . $data['last_name'] . ' was <b>'.$text.'</b>.'));
	        die();
	    }   

    }
    
    public function approve() {
	    $contact_id = (int)$this->input->get_post('contact_id');
	    $status = $this->input->get_post('status');
	    $query = $this->db->get_where('contacts', array('contact_id' => $contact_id));
	    
	    if ($query->num_rows() > 0) {
		    $data = $query->row_array();
		    
		    $code = rand(100000, 999999);
		    
			$text = 'DISAPPROVED';
		    if ($status === 'y') {
			    $text = 'APPROVED';
			    $this->db->update('contacts', array('approved' => $status, 'activation_code' => $code), array('contact_id' => $contact_id));    
			    $this->load->library('email');
				$this->email->from('jay_cruz@thefarm.com.ph', 'Jay');		
				$this->email->to($data['email']);
				$this->email->subject('Activation');
				$this->email->message('Code : <b>'.$code.'</b>');
			    $return = $this->input->get_post('return');		    
			}

			$this->output->set_content_type('application/json');
	        echo json_encode(array('message' => $data['first_name'] . ' ' . $data['last_name'] . ' was <b>'.$text.'</b>.'));
	        die();
		}
    }

    public function print_schedule() {
        $booking_id = (int)$this->uri->segment(4);
        $page = (int)$this->uri->segment(5);

        $this->db->select('contacts.*, bookings.title, bookings.start_date, bookings.end_date');
        $this->db->from('contacts');
        $this->db->join('bookings', 'bookings.guest_id = contacts.contact_id');
        $this->db->where('bookings.booking_id = '.$booking_id);
        $query = $this->db->get();
        $booking = $query->row_array();

        $begin = new DateTime(date('Y-m-d', (int)$booking['start_date']));
        $end = new DateTime(date('Y-m-d', (int)$booking['end_date']));

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $dates = array();

        foreach ( $period as $dt ) {
            $dates[] = $dt;
        }

        $data = array();
        $data['booking_id'] = $booking_id;
        $data['booking'] = $booking;
        $data['dates'] = $dates;
        $data['begin'] = $begin;
        $data['end'] = $end;
	
		$params = array();
		$params['booking_id'] = $booking_id;
		$params['show_guest_name'] = false;
		$this->load->library('Eventsbuilder', $params);
		$this->eventsbuilder->build();
		
		$events = $this->eventsbuilder->get_events();
        $_events = array();

        $prev_id = 0;

        foreach ($events as $event) {
            for ($i = strtotime($event['start']); $i < strtotime($event['end']); $i += 1800) {  // 1800 = half hour, 86400 = one day
                $tm = $i;
                $dt = date('Y-m-d', $i);
                $t = sprintf('%1$s', date('H:i', $tm));

                if ($event['booking_item_id'] === $prev_id) {
                    $event['title'] = '';
                    $event['item_name'] = '';
                    $event['class'] = 'noborder';
                    $_events[$dt][$t] = $event;
                }
                else {
                    $event['class'] = 'test';
                    $_events[$dt][$t] = $event;
                }

                $prev_id = $event['booking_item_id'];
            }
        }

        $this->load->library('Pdf');
        $mpdf = $this->pdf->load();

        $data['events'] = $_events;
        $data['duration'] = count($dates);

        $this->add_page($mpdf, $data, $dates, false, 0, 4, 1); // page 1
        $this->add_page($mpdf, $data, $dates, true, 4, 3); // page 2
        $this->add_page($mpdf, $data, $dates, false, 7, 4); // page 3
        $this->add_page($mpdf, $data, $dates, true, 11, 3); // page 4
        $this->add_page($mpdf, $data, $dates, false, 14, 4); // page 5
        $this->add_page($mpdf, $data, $dates, true, 18, 3); // page 6
        $this->add_page($mpdf, $data, $dates, false, 21, 4); // page 7
        $this->add_page($mpdf, $data, $dates, true, 25, 3); // page 8
        $this->add_page($mpdf, $data, $dates, false, 28, 4); // page 9
        $this->add_page($mpdf, $data, $dates, true, 32, 3); // page 10
        $this->add_page($mpdf, $data, $dates, false, 35, 4); // page 11

        $mpdf->SetTitle($booking['title']);
        $mpdf->Output();
    }

    private function add_page($mpdf, $data, $dates, $show_label, $start, $length, $day_start = null) {
        $dates_to_show = array_slice($dates, $start, $length);
        if ($dates_to_show) {
            $data['dates'] = $dates_to_show;
            $data['show_label'] = $show_label;
            $data['day_start'] = is_null($day_start) ? $start : $day_start;
            $html = $this->load->view('admin/account/print_schedule', $data, true);
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);
        }
    }
}
