<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends TF_Controller {

    public function new_event() {

        $data = [];
        $data['eventData'] = [];

        $this->load->view('admin/appointment_form', $data);
    }

    public function edit_event() {
        $eventId = $this->input->get_post('id');
        $eventApi = new EventApi();
        $event = $eventApi->get_event($eventId);

        $data = [];
        $data['eventData'] = $event;

        $this->load->view('admin/appointment_form', $data);
    }

    public function save_event() {



        $this->load->helper('event');
        $booking_id = $this->input->get_post('booking_id') ? $this->input->get_post('booking_id') : NULL;
        $event_id = $this->input->get_post('event_id') ? $this->input->get_post('event_id') : NULL;
        $item_id = $this->input->get_post('item_id');
        $end_date = $this->input->get_post('end_date');
        $end_time = $this->input->get_post('end_time');
        $start_date = $this->input->get_post('start_date');
        $start_time = $this->input->get_post('start_time');
        $status = $this->input->get_post('status');
        $notes = $this->input->get_post('notes');
        $booking_item_id = (int)$this->input->get_post('booking_item_id');
        $event_title = $this->input->get_post('event_title') ? $this->input->get_post('event_title') : '';
        $included = (int)$this->input->get_post('incl');
        $not_included = (int)$this->input->get_post('not_incl');
        $foc = (int)$this->input->get_post('foc');

        $update_calendar_views = $this->input->get_post('update_calendar_views');

        $eventData = [
            'EventId' => $event_id,
            'AllDay' => false,
            'Status' => $status,
            'EventTitle' => $event_title,
            'Notes' => $notes,
            'Incl' => $included,
            'NotIncl' => $not_included,
            'Foc' => $foc,
            'InclOsDoneNumber' => $this->input->get_post('incl_os_done_number') ? $this->input->get_post('incl_os_done_number') : null,
            'InclOsDoneAmount' => $this->input->get_post('incl_os_done_amount') ? $this->input->get_post('incl_os_done_amount') : null,
            'FocOsDoneNumber' => $this->input->get_post('foc_os_done_number') ? $this->input->get_post('foc_os_done_number') : null,
            'FocOsDoneAmount' => $this->input->get_post('foc_os_done_amount') ? $this->input->get_post('foc_os_done_amount') : null,
            'NotInclOsDoneNumber' => $this->input->get_post('not_incl_os_done_number') ? $this->input->get_post('not_incl_os_done_number') : null,
            'NotInclOsDoneAmount' => $this->input->get_post('not_incl_os_done_amount') ? $this->input->get_post('not_incl_os_done_amount') : null,
        ];

        $bookingEventUsers = [];

        if (!$booking_id) {
            // create the guest.
            $first_name = $this->input->get_post('first_name');
            $last_name = $this->input->get_post('last_name');
            $package_type = $this->input->get_post('package_type');
            $contact_id = $this->input->get_post('guest_id');
            $guestData = [];

            if (!$contact_id) {

                $guestData = [
                    'FirstName' => $first_name,
                    'LastName' => $last_name,
                    'DateJoined' => data('Y-m-d')
                ];

                $bookingEventUsers[] = ['User' => $guestData, 'IsGuest' => true, 'EventId' => $event_id];
            }

            $arrival = strtotime($this->input->get_post('arrival_date'));
            $departure = strtotime($this->input->get_post('departure_date'));

            $eventData['Booking'] = [
                'Guest' => $guestData,
                'Title' => $first_name . ' ' . $last_name . ' Personalized Program',
                'StartDate' => $arrival,
                'EndDate' => $departure,
                'AuthorId' => get_current_user_id(),
                'Personalized' => 1,
                'PackageTypeId' => $package_type,
                'Status' => 'confirmed'
            ];
        }
        else
        {
            $bookingGuest = \TheFarm\Models\BookingQuery::create()->findOneByBookingId($booking_id);
            $bookingEventUsers[] = ['UserId' => $bookingGuest->getGuestId(), 'IsGuest' => true, 'EventId' => $event_id];
        }

        if ($status === 'cancelled') {
            $eventData['CalledBy'] = $this->input->get_post('called_by') ? $this->input->get_post('called_by') : NULL;
            $eventData['CancelledBy'] = $this->input->get_post('cancelled_by') ? $this->input->get_post('cancelled_by') : NULL;
            $eventData['CancelledReason'] = $this->input->get_post('cancelled_reason');
            $eventData['DateCancelled'] = strtotime($this->input->get_post('date_cancelled'));
        }

        $eventData['StartDate'] = date('Y-m-d H:i:s', strtotime($start_date . ' ' . $start_time));
        $eventData['EndDate'] = date('Y-m-d H:i:s', strtotime($end_date . ' ' . $end_time));
        /* Event Data End */

        if ($facility = $this->input->get_post('facility_id')) {
            $event['FacilityId'] = $facility;
        }

        $assignedTo = array();
        if ($assignedTo = $this->input->get_post('assigned_to')) {
            if (!is_array($assignedTo)) $assignedTo = array((int)$assignedTo);

            foreach ($assignedTo as $item) {
                if ($item) $bookingEventUsers[] = ['UserId' => $item, 'IsGuest' => false, 'EventId' => $event_id];
            }
        }

        $eventData['BookingEventUsers'] = $bookingEventUsers;

        $eventData['ItemId'] = $item_id;
        $eventData['BookingId'] = $booking_id;

        $eventApi = new EventApi();

        try {
            $validate = $eventApi->validate_event($eventData);

            if ($validate) {
                $event = $eventApi->save_event($eventData);
                echo json_encode(to_full_calendar_event($event));
                exit (0);
            }
            else {
                echo json_encode($validate);
                exit (0);
            }
        }
        catch (Exception $exception) {
            echo json_encode($exception->getMessage());
            exit (0);
        }
    }

    public function delete_event($eventId) {

        $eventApi = new EventApi();
        $event = $eventApi->get_event($eventId);
        $event['IsActive'] = false;
        $event['DeletedBy'] = get_current_user_id();
        $event['DeletedDate'] = now();

        $event = $eventApi->save_event($event);
        echo json_encode($event);
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

        $data['booking_item_id'] = $booking_item_id;


        $this->load->view('admin/appointment', $data);
    }

    public function get_available_peoples($itemId = null)
    {
        $startTime = date('Y-m-d H:i:s', strtotime($this->input->get_post('start_time')));
        $endTime = date('Y-m-d H:i:s', strtotime($this->input->get_post('end_time')));
        if (is_null($itemId)) $itemId = $this->input->get_post('item_id');

        if (get_current_user_location_id()) {
            $locations = [0, get_current_user_location_id()];
        }
        else {
            $locations = [];
        }

        $userApi = new UserApi();
        $availableProviders = $userApi->get_users(false, $locations, $itemId, true, $startTime, $endTime);
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