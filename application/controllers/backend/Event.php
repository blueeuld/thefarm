<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends TF_Controller {

    public function new_event() {

        $bookingApi = new BookingApi();

        $date = $this->input->get_post('start');

        $data = [];
        $data['eventData'] = [];
        $bookings = $bookingApi->search_bookings($date, ['confirmed']);

        $bookingsArr = [];
        foreach ($bookings as $booking) {
            $bookingsArr[$booking['BookingId']] = $booking['Guest']['FirstName'] . ' ' . $booking['Guest']['LastName'];
        }

        $data['bookings'] = $bookingsArr;

        $endDate = new DateTime($_REQUEST['start']);
        $endDate->add(new DateInterval('P1W'));

        $date_range = createDateRangeArray($_REQUEST['start'], $endDate->format('Y-m-d'));
        $dates = array();
        foreach ($date_range as $date) $dates[$date] = date('m/d/Y', strtotime($date));

        $data['dates'] = $dates;

        $this->load->view('admin/appointment_form', $data);
    }

    public function edit_event() {
        $eventId = $this->input->get_post('id');
        $date = $this->input->get_post('start');
        $eventApi = new EventApi();
        $bookingApi = new BookingApi();
        $event = $eventApi->get_event($eventId);

        $data = [];
        $data['eventData'] = $event;

        $this->load->view('admin/appointment_form', $data);
    }

    public function save_event() {

    }

    public function delete_event() {

    }

    public function index() {

        $event_id = (int)$this->input->get_post('id');
        $startDate = $this->input->get_post('start');
        $item_id = (int)$this->input->get_post('item_id');
        $booking_id = (int)$this->input->get_post('booking_id');
        $assigned_to = (int)$this->input->get_post('assigned_to');
        $duration = (int)$this->input->get_post('duration');
        $booking_item_id = (int)$this->input->get_post('booking_item_id');

        if ($duration === 0) $duration = 60;

        $start_date_dt = new DateTime($startDate);
        $end_date_dt = new DateTime($startDate);
        $end_date_dt->add(new DateInterval('PT'.$duration.'M'));

        $event_data = array(
            'guest_id' => 0,
            'facility_id' => 0,
            'status' => '',
            'called_by' => 0,
            'cancelled_by' => 0,
            'cancelled_reason' => '',
            'date_cancelled' => now(),
            'max_provider' => 1,
            'duration' => 30,
            'author_id' => $_SESSION['ContactId'],
            'booking_id' => $booking_id,
            'item_id' => $item_id,
            'start_dt' => $start_date_dt->format('Y-m-d H:i:s'),
            'end_dt' => $end_date_dt->format('Y-m-d H:i:s'),
            'event_title' => $this->input->get_post('event_title'),
            'notes' => $this->input->get_post('notes'),
            'incl' => 0,
            'not_incl' => 0,
            'foc' => 0,
            'incl_os_done_number' => '',
            'incl_os_done_amount' => '',
            'not_incl_os_done_number' => '',
            'not_incl_os_done_amount' => '',
            'foc_os_done_number' => '',
            'foc_os_done_amount' => '',
        );


        if($event_id) {

            $this->db->select('booking_events.*, items.duration, items.max_provider, 
                bookings.booking_id, bookings.guest_id, booking_events.notes, 
                booking_items.item_id');
            $this->db->from('booking_events');
            $this->db->join('booking_items', 'booking_events.booking_item_id = booking_items.booking_item_id', 'left');
            $this->db->join('bookings', 'bookings.booking_id = booking_items.booking_id', 'left');
            $this->db->join('items', 'booking_items.item_id=items.item_id', 'left');
            $this->db->where('event_id = ', $event_id);
            $this->db->where('items.is_active', 1);
            $query = $this->db->get();
            $event_data = $query->row_array();

            $query->free_result();
        }

        $date_cancelled = (int)$event_data['date_cancelled'] === 0 ? now() : (int)$event_data['date_cancelled'];

        $booking_id = (int)$event_data['booking_id'];
        $data = array(
            'guest_id' => (int)$event_data['guest_id'],
            'event_id' => (int)$event_id,
            'author_id' => (int)$event_data['author_id'],
            'item_id' => (int)$event_data['item_id'],
            'facility_id' => (int)$event_data['facility_id'],
            'booking_id' => $booking_id,
            'status' => $event_data['status'],
            'event_title' => $event_data['event_title'],
            'called_by' => (int)$event_data['called_by'],
            'cancelled_by' => (int)$event_data['cancelled_by'],
            'cancelled_reason' => $event_data['cancelled_reason'],
            'notes' => $event_data['notes'],
            'duration' => (int)$event_data['duration'],
            'max_provider' => (int)$event_data['max_provider'],
            'date_cancelled' => date('m/d/Y', $date_cancelled),
            'start_date' => date('Y-m-d', strtotime($event_data['start_dt'])),
            'start_time' => date('H:i', strtotime($event_data['start_dt'])),
            'end_date' => date('Y-m-d', strtotime($event_data['end_dt'])),
            'end_time' => date('H:i', strtotime($event_data['end_dt'])),
            'incl' => $event_data['incl'],
            'foc' => $event_data['foc'],
            'not_incl' => $event_data['not_incl'],
            'incl_os_done_number' => $event_data['incl_os_done_number'],
            'incl_os_done_amount' => $event_data['incl_os_done_amount'],
            'not_incl_os_done_number' => $event_data['not_incl_os_done_number'],
            'not_incl_os_done_amount' => $event_data['not_incl_os_done_amount'],
            'foc_os_done_number' => $event_data['foc_os_done_number'],
            'foc_os_done_amount' => $event_data['foc_os_done_amount']
        );

        $data['assigned_to'] = $assigned_to;

        if ($event_id > 0) {

            $query = $this->db->get_where('booking_event_users', 'event_id='.$event_id);
            $assigned_to = array();
            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $assigned_to[] = (int)$row['staff_id'];
                }
            }
            $query->free_result();
            $data['assigned_to'] = $assigned_to;
        }

        $facilities = array('' => '');

        $this->db->select('facility_id, facility_name');
        $this->db->from('facilities');
        $this->db->where('facilities.status', 1);
        if (get_current_user_locations())
        {
            $this->db->where_in('facilities.location_id', get_current_user_locations());
        }

        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $facilities[$row['facility_id']] = $row['facility_name'];
        }
        $query->free_result();
        $params = array();
        $params['start'] = date('Y-m-d H:i:s', strtotime($event_data['start_dt']));
        $params['end'] = date('Y-m-d H:i:s', strtotime($event_data['end_dt']));
        $params['event'] = (int)$event_id;
        $params['status'] = $event_data['status'];
        $params['item_id'] = (int)$event_data['item_id'];
        $params['booking_id'] = $booking_id;
        $params['exclude_peoples'] = array();
        $params['exclude_facilities'] = array();
        $params['exclude_status'] = array();
        $params['people'] = $assigned_to ? $assigned_to[0] : false;

        $this->load->library('availability', $params);
        $this->availability->validate();

        $select_facility = array(0 => '-Select-');

        $facilities = keyval($this->availability->get_available_facilities(), 'facility_id', 'facility_name', false, $select_facility);
        $data['facilities'] = $facilities;

        $params = array(
            'start_date' => date('Y-m-d H:i:s', strtotime($event_data['start_dt'])),
            'end_date' => date('Y-m-d H:i:s', strtotime($event_data['end_dt'])),
            'item_id' => (int)$event_data['item_id']
        );

        $this->load->library('ProviderAvailability', $params);

        $select_provider = array(0 => '-Select-');
        $providers = keyval($this->provideravailability->get_available(), 'contact_id', array('first_name', 'last_name'), 'position', $select_provider);
        $data['providers'] = $providers;

        $statuses = array_merge(array('' => '-Select-'), get_event_statuses());
        $data['statuses'] = $statuses;
        $data['dates'] = array();
        if ($booking_id === 0) {

            $bookings = array('' => '-Select-');
            $this->db->select('contacts.first_name, contacts.last_name, bookings.booking_id, packages.package_name');
            $this->db->from('contacts');
            $this->db->join('bookings', 'bookings.guest_id = contacts.contact_id');
            $this->db->join('packages', 'bookings.package_id = packages.package_id', 'left');
            $this->db->where(sprintf('\'%s\' BETWEEN FROM_UNIXTIME(tf_bookings.start_date) AND FROM_UNIXTIME(tf_bookings.end_date)', date('Y-m-d', strtotime($event_data['start_dt']))));
            $this->db->where('bookings.status', 'confirmed');

            $query = $this->db->get();


            foreach ($query->result_array() as $row) {
                $bookings[$row['booking_id']] = $row['first_name'] . ' ' . $row['last_name'] . ($row['package_name'] ? ' - ' . $row['package_name'] : '');
            }

            $endDate = new DateTime($_REQUEST['start']);
            $endDate->add(new DateInterval('P1W'));

            $date_range = createDateRangeArray($_REQUEST['start'], $endDate->format('Y-m-d'));
            $dates = array();
            foreach ($date_range as $date) $dates[$date] = date('m/d/Y', strtotime($date));

            $query->free_result();
            $data['dates'] = $dates;
            $data['bookings'] = $bookings;
        }
        else
        {
            $this->db->select('contacts.first_name, contacts.last_name, bookings.title, bookings.booking_id, bookings.start_date, bookings.end_date');
            $this->db->from('contacts');
            $this->db->join('bookings', 'bookings.guest_id = contacts.contact_id');
            $this->db->where('booking_id', $booking_id);
            $query = $this->db->get();
            $result = $query->row_array();

            $date_range = createDateRangeArray(date('Y-m-d', $result['start_date']), date('Y-m-d', $result['end_date']));
            $dates = array();
            foreach ($date_range as $date) $dates[$date] = date('m/d/Y', strtotime($date));

            $data['dates'] = $dates;
            $data['booking_data'] = $result;

            $query->free_result();
        }

        $query = $this->db->get('package_types');
        $package_types = array('' => '-Select Package-');
        foreach ($query->result_array() as $row) {
            $package_types[$row['package_type_id']] = $row['package_type_name'];
        }

        $data['package_types'] = $package_types;

        $data['times'] = createTimeRangeArray(1800*12, 3600*23, 60*10);

        $data['booking_item_id'] = $booking_item_id;

        $data['reasons'] = array('Reason 1', 'Reason 2', 'Reason 3', 'N/A');

        $audit_users = array();
        $audit_users[get_current_user_id()] = 'Me';
        foreach (get_audit_users(array(get_current_user_id())) as $row) {
            $audit_users[$row['contact_id']] = $row['first_name'] . ' ' . $row['last_name'];;
        }

        $data['audit_users'] = $audit_users;

        $this->load->view('admin/appointment', $data);
    }

    public function get_available_peoples($itemId)
    {
        $startTime = date('Y-m-d H:i:s', strtotime($this->input->get_post('start_time')));
        $endTime = date('Y-m-d H:i:s', strtotime($this->input->get_post('end_time')));


        $availableProviders = $this->userApi->get_users(true, [0, get_current_user_location_id()], $itemId, true, $startTime, $endTime);
        $this->output->set_content_type('application/json')->set_output(json_encode($availableProviders));

//        $availableProviders = [];
//
//
//        $this->TF->db->distinct();
//        $this->TF->db->select(implode(', ', $this->select));
//        $this->TF->db->from('user_work_plan_time');
//        $this->TF->db->join('contacts', 'user_work_plan_time.contact_id = contacts.contact_id');
//        $this->TF->db->join('users', 'users.contact_id = contacts.contact_id');
//        $this->TF->db->join('groups', 'groups.group_id = users.group_id');
//        $this->TF->db->join('items_related_users', 'contacts.contact_id = items_related_users.contact_id');
//        if (get_current_user_location_id() !== 0) {
//            $this->TF->db->where('users.location_id IN (0, '.get_current_user_location_id().')');
//        }
//
//        if ($this->item_id) {
//            $this->TF->db->where('items_related_users.item_id', $this->item_id);
//        }
//
//        $this->TF->db->where('groups.include_in_provider_list = "y"');
//        $this->TF->db->where("((start_date BETWEEN '$check_in' AND '$check_out') OR (end_date BETWEEN '$check_in' AND '$check_out') OR ('$check_in' BETWEEN start_date AND end_date))");
//        $this->TF->db->order_by('users.user_order', 'asc');
//
//        $q = $this->TF->db->get();
//
//        return $q->result_array();
//        $this->output->set_content_type('application/json')->set_output(json_encode($this->provideravailability->get_available()));
    }

}