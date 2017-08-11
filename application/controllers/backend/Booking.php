<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('BOOKING_STATUS_CANCELLED', 0);
define('BOOKING_STATUS_TENTATIVE', 1);
define('BOOKING_STATUS_COMPLETED', 2);
define('BOOKING_STATUS_CONFIRMED', 3);


class Booking extends TF_Controller {

	public function index()
	{
		$booking_id = $this->input->get_post('id') ? $this->input->get_post('id') : null;
		$guest_id = $this->input->get_post('guest_id') ? $this->input->get_post('guest_id') : null;
        $personalized = (int)$this->input->get_post('personalized');
        $room_id = $this->input->get_post('room_id') ? $this->input->get_post('room_id') : null;
		$status = $this->input->get_post('status');
		$package_id = $this->input->get_post('package_id') ? $this->input->get_post('package_id') : null;
        $data = array(
            'BookingId' => $booking_id,
			'Title' => $this->input->get_post('title'),
			'PackageId' => $package_id,
			'Status' => $status,
			'GuestId' => $guest_id,
			'Fax' => (int)$this->input->get_post('fax'),
            'Personalized' => $personalized,
            'RoomId' => $room_id,
            'Restrictions' => $this->input->get_post('restrictions'),
            'AuthorId' => get_current_user_id(),
            'Notes' => $this->input->get_post('notes')
		);

		if ($this->input->get_post('start_date')) {
			$data['StartDate'] = strtotime($this->input->get_post('start_date'));
		}

		if ($this->input->get_post('end_date')) {
			$data['EndDate'] = strtotime($this->input->get_post('end_date'));
        }

		if ($notes = $this->input->get_post('notes')) {
			$data['Notes'] = $notes;
		}

		$booking = null;
		
		if (current_user_can('CanManageGuestBookings')) {

            if ($this->input->get_post('package_items')) {
                foreach ($_POST['package_items'] as $id => $item) {
                    if ($id) {
                        $included = isset($item['included']) ? 1 : 0;
                        $foc = isset($item['foc']) ? 1 : 0;
                        $upsell = isset($item['upsell']) ? 1 : 0;
                        $upgrade = isset($item['upgrade']) ? 1 : 0;

                        $bookingItemData = array(
                            'BookingId' => $booking_id,
                            'ItemId' => (int)$item['item_id'],
                            'Quantity' => (int)$item['qty'],
                            'Included' => $included,
                            'Upsell' => $upsell,
                            'Foc' => $foc,
                            'Upgrade' => $upgrade);

                        if (stripos($id, 'new') !== false) {
                            $bookingItemData['inventory'] = isset($data['quantity']) ? $data['quantity'] : 1;
                            $data['Items'][] = $bookingItemData;
                        }
                    }
                }
            }

            $config = $this->db->get_where('upload_prefs', array('upload_id' => 1))->row_array();
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('attachment')) {
                $file = $this->upload->data();

                $attachments = [[
                    'BookingId' => $booking_id,
                    'File' => [
                        'FileName' => $file['file_name'],
                        'Title' => $file['file_name'],
                        'FileSize' => $file['file_size'],
                        'UploadDate' => now(),
                        'UploadId' => 1
                    ]
                ]];

                $data['Attachments'] = $attachments;
            }

            if ($this->input->get_post('booking_forms'))
            {
                $forms = [];
                foreach ($_REQUEST['booking_forms'] as $id => $row) {
                    $required = isset($row['required']) ? true : false;
                    $submitted = isset($row['submitted']) ? true : false;
                    $notify_users = isset($row['notify_user_on_submit']) ? serialize($row['notify_user_on_submit']) : '';

                    $forms[] = [
                        'Required' => $required,
                        'Submitted' => $submitted,
                        'NotifyUsersOnSubmit' => $notify_users,
                        'FormId' => $id,
                        'BookingId' => $booking_id
                    ];
                }

                $data['Forms'] = $forms;
            }

            var_dump($data);

            $bookingApi = new BookingApi();
            $booking = $bookingApi->save_booking($data, isset($_REQUEST['skip_confirmation']));

            var_dump($booking);

        }

//        if ($booking) {
//            if ($booking['Status'] === 'confirmed') {
//                redirect('backend/account/edit/' . $guest_id . '/' . $booking_id . '#appointment');
//            } else {
//                redirect('backend/account/edit/' . $guest_id . '#bookings');
//            }
//        }
	}

//	public function initItemSchdules() {
//
//        $this->db->insert('booking_items', $data);
//        $booking_item_id = $this->db->insert_id();
//        $exclude[] = $booking_item_id;
//        $facility_id = 0;
//
//        if ($_item['related_facilities']) {
//            $facility_id = $_item['related_facilities'][0]['facility_id'];
//        }
//        $query = $this->db->get_where('item_day_time_settings', array('item_id' => $item['item_id']));
//
//        if ($query->num_rows() > 0) {
//            $count = 0;
//
//            $booking_dates = createDateRangeArray(date('Y-m-d', $start_date), date('Y-m-d', $end_date));
//
//            foreach ($query->result_array() as $row) {
//                $day_settings = explode(',', trim($row['day_settings']));
//                $time_settings = explode(',', trim($row['time_settings']));
//                if ($count === (int)$item['qty']) break;
//
//                foreach ($booking_dates as $date) {
//
//                    if ($count === (int)$item['qty']) break;
//
//                    foreach ($time_settings as $tm) {
//                        if ($tm) {
//
//                            $_start_date = new DateTime($date . ' ' . $tm);
//                            $_end_date = new DateTime($date . ' ' . $tm);
//                            $_end_date->add(new DateInterval('PT' . $_item['duration'] . 'M'));
//                            $_day = $_start_date->format('D');
//
//                            if ($count === (int)$item['qty']) break;
//
//                            if (count($day_settings) === 0 || in_array($_day, $day_settings)) {
//                                $calendar_data = array(
//                                    'start_dt' => $_start_date->format('Y-m-d H:i:s'),
//                                    'end_dt' => $_end_date->format('Y-m-d H:i:s'),
//                                    'entry_date' => now(),
//                                    'item_id' => $item['item_id'],
//                                    'booking_item_id' => $booking_item_id,
//                                    'status' => 'confirmed',
//                                    'facility_id' => $facility_id
//                                );
//                                $this->db->insert('booking_events', $calendar_data);
//                                $count++;
//                            }
//                        }
//                    }
//
//                }
//            }
//        }
//    }

    public function create($contactId) {
	    $bookingApi = new BookingApi();
	    $bookingApi->get_package_types();

        $data = ['bookingData' => false, 'contact_id' => $contactId];


        $this->load->view('admin/booking_form', $data);
    }

	public function edit($bookingId)
	{

	    $bookingApi = new BookingApi();
	    $bookingData = $bookingApi->get_booking($bookingId);

	    $data = ['bookingData' => $bookingData];

		$this->load->view('admin/booking_form', $data);
	}

	public function delete() {

		$id = (int)$this->uri->segment(4);
		$confirm = $this->input->get_post('confirm');
		if ($id && $confirm && $confirm === 'y') {

			//@TODO add verification.

            $this->db->update('bookings', array('is_active' => 0), 'booking_id='.$id);

//			$this->db->delete('bookings', array('booking_id' => $id));
//			$this->db->delete('booking_items', array('booking_id' => $id));
//			$this->db->delete('booking_forms', array('booking_id' => $id));
//			$this->db->delete('booking_attachments', array('booking_id' => $id));


			if ($return = $this->input->get_post('return'))
				redirect($return);
		}

		redirect('backend/services');
	}

	public function form() {
        $booking_id = (int)$this->uri->segment(4);
        $form_id = (int)$this->uri->segment(5);

        $data['booking_id'] = $booking_id;
        $data['form_id'] = $form_id;

        $this->db->from('forms');
        $this->db->join('booking_forms', 'booking_forms.form_id = forms.form_id');
        $this->db->where('booking_forms.form_id', $form_id);
        $this->db->where('booking_forms.booking_id', $booking_id);

        $query = $this->db->get();
        $form = $query->row_array();

        $data['field_ids'] = $form['field_ids'];
        $data['title'] = $form['form_name'];
        $data['completed_by'] = (int)$form['completed_by'];

        $this->load->library('FormBuilder');

        $this->load->view('admin/booking/form', $data);
    }
}
