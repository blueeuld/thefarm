<?php

class EventApi {

    public function save_event($eventData) {

        try {
            $event = new \TheFarm\Models\BookingEvent();

            if (isset($eventData['EventId']) && $eventData['EventId']) {
                $event = \TheFarm\Models\BookingEventQuery::create()->findOneByEventId($eventData['EventId']);
                $event->fromArray($eventData);
            }
            else {
                $event->fromArray($eventData);
            }

            $eventUsers = $event->getBookingEventUsers();

            if (isset($eventData['BookingEventUsers'])) {

                $savedEventUsers = new \Propel\Runtime\Collection\ObjectCollection();

                foreach ($eventData['BookingEventUsers'] as $eventUser) {
                    $userData = new \TheFarm\Models\BookingEventUser();
                    $userData->fromArray($eventUser);

                    if ($eventUsers->contains($userData)) {
                        $userData = $eventUsers->get($eventUsers->search($userData));
                        $userData->fromArray($eventUser);
                        $savedEventUsers->append($userData);
                    } else {
                        $event->addBookingEventUser($userData);
                        $savedEventUsers->append($userData);
                    }
                }

                foreach ($eventUsers as $eventUser) {
                    if (!$savedEventUsers->contains($eventUser)) {
                        $eventUsers->removeObject($eventUser);
                        $eventUser->delete();
                    }
                }
            }

            $event->save();

            $eventArr = $event->toArray();
            $eventArr['BookingEventUsers'] = $event->getBookingEventUsers()->toArray();
            $eventArr['BookingItem'] = $event->getBookingItem()->toArray();
            $eventArr['BookingItem']['Booking'] = $event->getBookingItem()->getBooking()->toArray();
            $eventArr['BookingItem']['Booking']['Guest'] = $event->getBookingItem()->getBooking()->getContactRelatedByGuestId()->toArray();
            $eventArr['BookingItem']['Item'] = $event->getBookingItem()->getItem()->toArray();

            return $eventArr;
        }
        catch (Exception $exception) {
            return $exception;
        }
    }

    public function get_event($eventId) {
        $search = \TheFarm\Models\BookingEventQuery::create()->findOneByEventId($eventId);
        return $search->toArray();
    }

    public function get_upcoming_events($categories, $locations, $eventStatus, $unAssignedEventOnly) {

        return $this->get_events(null, null, null, $categories, $locations, $eventStatus, true, 'P7D', $unAssignedEventOnly);

    }

    public function get_events($start = null, $end = null, $guestId = null, $categories = [], $locations = [], $eventStatus = null, $upcoming = false, $upcomingThreshold = 'P7D', $unAssignedEventOnly = false) {

         $search = \TheFarm\Models\BookingEventQuery::create();

         if ($guestId) {
             $search = $search->useBookingItemQuery()->useBookingQuery()
                 ->filterByStatus('confirmed')
                 ->filterByGuestId($guestId)->endUse()->endUse();
         }

         if ($categories) {
             $search = $search->useBookingItemQuery()->useItemQuery()->useItemCategoryQuery()->filterByCategoryId($categories)->endUse()->endUse()->endUse();
         }

         if ($unAssignedEventOnly) {
             $search = $search->useBookingEventUserQuery(null, 'LEFT JOIN')->filterByEventId(null)->endUse();
         }

        if ($upcoming) {

            $start = new DateTime();
            $end = new DateTime();
            $end->add(new DateInterval($upcomingThreshold));

            $search = $search->filterByEndDate(['min' => $start->format('Y-m-d H:i:s'), 'max' => $end->format('Y-m-d H:i:s')]);
//
//            $this->start = $start->format('Y-m-d H:i:s');
//            $this->end = $end->format('Y-m-d H:i:s');
//            $this->TF->db->where("tf_booking_events.end_dt BETWEEN '{$this->start}' AND '{$this->end}'");
        }
        elseif ($start && $end) {
             $start = new DateTime($start);
             $end = new DateTime($end);
             $search = $search->filterByEndDate(['min' => $start->format('Y-m-d H:i:s'), 'max' => $end->format('Y-m-d H:i:s')]);
        }


        $search = $search->useBookingQuery()->filterByStatus('confirmed')->endUse();

         $search = $search->useBookingItemQuery()->useBookingQuery()->filterByIsActive(true)->endUse()->endUse();

         $search->orderByStartDate();

         $events = $search->find();
         $eventsArray = [];

         foreach ($events as $key => $event) {
             $eventsArray[$key] = $event->toArray();
             if ($event->getBookingItem()) {
                 $eventsArray[$key]['BookingItem'] = $event->getBookingItem()->toArray();
                 $eventsArray[$key]['BookingItem']['Item'] = $event->getBookingItem()->getItem()->toArray();
                 $eventsArray[$key]['BookingItem']['Item']['Categories'] = $event->getBookingItem()->getItem()->getItemCategoriesJoinCategory()->toArray();
                 $eventsArray[$key]['BookingItem']['Booking'] = $event->getBookingItem()->getBooking()->toArray();
                 $eventsArray[$key]['BookingItem']['Booking']['Guest'] = $event->getBookingItem()->getBooking()->getContactRelatedByGuestId()->toArray();
             }

             if ($event->getFacility()) {
                 $eventsArray[$key]['Facility'] = $event->getFacility()->toArray();
             }

             if ($event->getBookingEventUsers()->count() > 0) {
                $eventsArray[$key]['BookingEventUsers'] = $event->getBookingEventUsersJoinContact()->toArray();
             }

         }
         return $eventsArray;
    }

    public function get_available_providers($startTime, $endTime, $bookingId) {

        if (!$this->start && !$this->end && $this->status != 'confirmed') return TRUE;

        if ($this->exclude_status && in_array($this->status, $this->exclude_status)) return TRUE;

        if ($this->booking_id === 0) return TRUE;

        if ($this->is_item_no_validate())
        {
            return TRUE;
        }

        $start = new DateTime($startTime);
        $start->add(new DateInterval('PT1M'));

        $end = new DateTime($endTime);
        $end->sub(new DateInterval('PT1M'));

        $check_in = $start->format('Y-m-d H:i:s');
        $check_out = $end->format('Y-m-d H:i:s');

        $events = \TheFarm\Models\BookingEventQuery::create()
            ->useBookingQuery()
                ->filterByIsActive(true)
                ->filterByBookingId($bookingId)
            ->endUse()
            ->filterByStatusCd(['cancelled', 'no-show'], '!=')
            ->where("((start_dt BETWEEN '$check_in' AND '$check_out') OR (end_dt BETWEEN '$check_in' AND '$check_out') OR ('$check_in' BETWEEN start_dt AND end_dt))");


        // check guest.
        $this->TF->db->distinct();
        $this->TF->db->select("booking_events.*, bookings.fax, item_categories.category_id");
        $this->TF->db->from('booking_events');
        $this->TF->db->join('booking_items', 'booking_events.booking_item_id = booking_items.booking_item_id');

        $this->TF->db->join('items', 'booking_items.item_id = items.item_id');
        $this->TF->db->join('item_categories', 'item_categories.item_id = items.item_id');

        $this->TF->db->join('bookings', 'bookings.booking_id = booking_items.booking_id', 'left');
        $this->TF->db->where_not_in('booking_events.status', array('cancelled', 'no-show'));
        $this->TF->db->where('bookings.booking_id='.$this->booking_id);
        $this->TF->db->where('bookings.is_active', 1);


        if ($this->exclude_categories) {
            if (!is_array($this->exclude_categories)) {
                $this->exclude_categories = array($this->exclude_categories);
            }
            $this->TF->db->where_not_in('item_categories.category_id', $this->exclude_categories);
        }

        if ($this->event) $this->TF->db->where('booking_events.event_id != ', $this->event);

        $start = new DateTime($this->start);
        $start->add(new DateInterval('PT1M'));

        $end = new DateTime($this->end);
        $end->sub(new DateInterval('PT1M'));

        $check_in = $start->format('Y-m-d H:i:s');
        $check_out = $end->format('Y-m-d H:i:s');

        $this->TF->db->where("((start_dt BETWEEN '$check_in' AND '$check_out') OR (end_dt BETWEEN '$check_in' AND '$check_out') OR ('$check_in' BETWEEN start_dt AND end_dt))");

        $query = $this->TF->db->get();

//        $this->errors[] = $this->TF->db->last_query();

        if ($query->num_rows() > 0) {
            $guest_schedules = $query->result_array();

            $existing_schedule = count($guest_schedules);
            $fax = (int)$guest_schedules[0]['fax'];

            if ($existing_schedule >= $fax) {
                if ($this->is_frontend) {
                    $this->errors[] = 'You have an existing appointment on the date and time selected.';
                }
                else {
                    $this->errors[] = 'The guest selected has existing appointment on the date and time selected.';
                }
                return false;
            }
        }

        $query->free_result();
        // get provider working schedule.
        if ($this->people) {
            $user = get_users($this->people);
            if ($user) {
                $user = $user[0];
                $location_id = $user['location_id'];
                if (!current_user_can('CanEditSchedules'.$location_id)) {
                    $this->errors[] = 'You dont have permissions to assign this provider.';
                    return false;
                }
            }

            $date = date('Y-m-d', strtotime($this->start));
            $providers = get_available_providers($date, $this->people);

            //$providers = get_provider_list(false, $this->people);

            if ($providers) {

                foreach ($providers as $row) {

//                    $work_plan = unserialize($row['work_plan']);
//                    $first_name = $row['first_name'];
//                    if ($work_plan) {
//                        $start_week_l = date('l', strtotime($this->start));
//                        $date = date('Y-m-d', strtotime($this->start));
//
//                        if (isset($work_plan[$date]) && !is_array($work_plan[$date])) {
//                            $this->exclude_peoples[] = (int)$row['contact_id'];
//                            $this->errors[] = sprintf('%s is on %s on the date selected.', $first_name, $work_plan[$date]);
//                        } elseif (isset($work_plan[$date])) {
//                            //sort time
//                            $w = $work_plan[$date];
//
//                            sort($w);
//                            $has_working_schedule = false;
//                            foreach ($w as $t) {
//                                $start_ts = new DateTime($date . ' ' . $t);
//                                $end_ts = new DateTime($date . ' ' . $t);
//                                $end_ts->add(new DateInterval('PT59M'));
//                                if ($start_ts <= $this->start_ts && $end_ts >= $this->start_ts) {
//                                    $has_working_schedule = true;
//                                    break;
//                                }
//                            }
//
//                            if ($has_working_schedule === false) {
//                                $this->exclude_peoples[] = (int)$row['contact_id'];
//                                $this->errors[] = sprintf('%s has no working schedule on the date and time selected. <br />%s: <br/>%s', $first_name, $start_week_l, implode('<br />', $w));
//                            }
//                        }
//                    }


                    $this->TF->db->select('*');
                    $this->TF->db->join('booking_event_users', 'booking_events.event_id = booking_event_users.event_id');
                    $this->TF->db->where_in('booking_event_users.staff_id', $this->people);
                    $this->TF->db->where('booking_event_users.is_guest', 0);
                    //$this->TF->db->where_not_in('status', array('cancelled', 'no-show'));
                    if ($this->event) $this->TF->db->where('booking_events.event_id !=', $this->event);
                    $this->TF->db->where("((start_dt BETWEEN '$check_in' AND '$check_out') OR (end_dt BETWEEN '$check_in' AND '$check_out') OR ('$check_in' BETWEEN start_dt AND end_dt))");
                    $query = $this->TF->db->get('booking_events');

                    if ($query->num_rows() > 0) {
                        $event = $query->row_array();
                        $this->exclude_peoples[] = (int)$row['contact_id'];
                        $event_info = get_event($event['event_id']);
                        $reason = sprintf('Guest : <b>%s</b><br />Start : <b>%s</b><br />End : <b>%s</b>', $event_info['guest_name'], $event_info['start'], $event_info['end']);
                        $this->errors[] = sprintf('%s is not available at booking time.<br />%s', $row['first_name'], $reason);
                    }
                    $query->free_result();
                }
            }
        }

//		$this->errors[] = $this->TF->db->last_query();

        if ($this->room) {

            $this->TF->db->distinct();
            $this->TF->db->select("facilities.facility_name, booking_events.facility_id, facilities.max_accomodation");
            $this->TF->db->from('booking_events');
            $this->TF->db->join('booking_items', 'booking_events.booking_item_id = booking_items.booking_item_id');
            $this->TF->db->join('facilities', 'facilities.facility_id = booking_events.facility_id', 'left');
            $this->TF->db->join('bookings', 'bookings.booking_id = booking_items.booking_id', 'left');
            $this->TF->db->where('booking_events.status', 'confirmed');
            $this->TF->db->where('facilities.status', 1);
            $this->TF->db->where('booking_events.facility_id', $this->room);


            if ($this->event) $this->TF->db->where('booking_events.event_id != ', $this->event);
            $this->TF->db->where("'{$this->start}' <= DATE_SUB(end_dt, INTERVAL 1 MINUTE) AND '{$this->end}' >= start_dt");
            $query = $this->TF->db->get();

            if ($query->num_rows() > 0) {

                foreach ($query->result_array() as $row) {

                    $max_accomodation = intval($row['max_accomodation']);
                    $facility_name = $row['facility_name'];

                    $this->TF->db->select("COUNT(*) as existing_accomodation");
                    $this->TF->db->from('booking_events');
                    $this->TF->db->join('booking_items', 'booking_events.booking_item_id = booking_items.booking_item_id');
                    $this->TF->db->join('bookings', 'bookings.booking_id = booking_items.booking_id', 'left');
                    $this->TF->db->where_not_in('booking_events.status', array('cancelled', 'no-show'));
                    $this->TF->db->where('booking_events.facility_id', (int)$row['facility_id']);
                    if ($this->event) $this->TF->db->where('booking_events.event_id != ', $this->event);
                    $this->TF->db->where("'{$this->start}' <= DATE_ADD(end_dt, INTERVAL 1 MINUTE) AND '{$this->end}' >= start_dt");
                    $row1 = $this->TF->db->get()->row_array();
                    $existing_accomodation = intval($row1['existing_accomodation']);

                    if ($existing_accomodation >= $max_accomodation) {
                        $this->exclude_facilities[] = (int)$row['facility_id'];
                        $this->errors[] = 'The room you selected is no longer available at booking time.';
                    }
                }
            }
            $query->free_result();
        }
        return count($this->errors) == 0;
    }

}