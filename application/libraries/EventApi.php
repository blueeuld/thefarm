<?php

class EventApi {

    public function validate_event($eventData) {

//        if (!$this->start && !$this->end && $this->status != 'confirmed') return TRUE;
//
//        if ($this->exclude_status && in_array($this->status, $this->exclude_status)) return TRUE;
//
//        if ($this->booking_id === 0) return TRUE;
//
//        if ($this->is_item_no_validate())
//        {
//            return TRUE;
//        }

//        print_r($eventData);

        if (!$eventData['StartDate'] && !$eventData['EndDate'] && $eventData['Status'] !== 'confirmed') {
            return true;
        }
        elseif (is_null($eventData['BookingId'])) {
            return true;
        }

        try {

            $search = \TheFarm\Models\BookingEventQuery::create()
                ->filterByStatus(['cancelled', 'no-show', 'completed'], \Propel\Runtime\ActiveQuery\Criteria::NOT_IN)
                ->useBookingQuery()->filterByIsActive(true)->useContactRelatedByGuestIdQuery()->filterByIsActive(true)->endUse()->endUse()
                ->useItemQuery()->useItemCategoryQuery()->filterByCategoryId([12, 3], \Propel\Runtime\ActiveQuery\Criteria::NOT_IN)->endUse()->endUse();

            if ($eventData['EventId']) {
                $search = $search->filterByEventId($eventData['EventId'], '!=');
            }

            $search = $search->filterByBookingId($eventData['BookingId']);

            $start = new DateTime($eventData['StartDate']);
            $start->add(new DateInterval('PT1M'));

            $end = new DateTime($eventData['EndDate']);
            $end->sub(new DateInterval('PT1M'));

            $check_in = $start->format('Y-m-d H:i:s');
            $check_out = $end->format('Y-m-d H:i:s');

            $search = $search->where("((start_dt BETWEEN '$check_in' AND '$check_out') OR (end_dt BETWEEN '$check_in' AND '$check_out') OR ('$check_in' BETWEEN start_dt AND end_dt))");

            $results = $search->find();

            if ($results->count() > 0) {
                throw new Exception('The guest selected has existing appointment on the date and time selected.');
            }

            // get provider working schedule.
            if ($eventData['BookingEventUsers']) {

                $date = date('Y-m-d', strtotime($eventData['StartDate']));

                $userApi = new UserApi();
                $availableProviders = $userApi->get_users(false, null, $eventData['ItemId'], true, $date);

                if ($availableProviders) {

                    foreach ($availableProviders as $row) {

                        $search = \TheFarm\Models\BookingEventQuery::create()
                            ->useEventUserQuery()->filterByUserId($row['ContactId'])->endUse();

                        if ($eventData['EventId']) {
                            $search = $search->filterByEventId($eventData['EventId'], '!=');
                        }

                        $search = $search->where("((start_dt BETWEEN '$check_in' AND '$check_out') OR (end_dt BETWEEN '$check_in' AND '$check_out') OR ('$check_in' BETWEEN start_dt AND end_dt))");

                        if ($result = $search->findOne()) {
                            throw new Exception(sprintf('Guest : <b>%s</b><br />Start : <b>%s</b><br />End : <b>%s</b>', $result['Booking']['Guest']['FirstName'] . ' ' . $result['Booking']['Guest']['LastName'], $result['StartDate'], $result['EndDate']));
                        }
                    }
                }
            }

            // Validate room/facility.
            if (isset($eventData['FacilityId']) && $eventData['FacilityId']) {

                $search = \TheFarm\Models\BookingEventQuery::create()
                    ->filterByFacilityId($eventData['FacilityId'])
                    ->useFacilityQuery()->filterByStatus(true)->endUse()
                    ->useBookingQuery()->filterByStatus('confirmed')->filterByIsActive(true)->endUse();

                if ($eventData['EventId']) {
                    $search = $search->filterByEventId($eventData['EventId'], '!=');
                }

                $search = $search->where(sprintf("'%s' <= DATE_SUB(end_dt, INTERVAL 1 MINUTE) AND '%s' >= start_dt", $eventData['StartDate'], $eventData['EndDate']));

                $events = $search->find();

                if ($events->count() > 0) {

                    foreach ($events as $event) {


//                        $max_accomodation = $event->get intval($row['max_accomodation']);
//                        $facility_name = $row['facility_name'];
//
//                        $this->TF->db->select("COUNT(*) as existing_accomodation");
//                        $this->TF->db->from('booking_events');
//                        $this->TF->db->join('booking_items', 'booking_events.booking_item_id = booking_items.booking_item_id');
//                        $this->TF->db->join('bookings', 'bookings.booking_id = booking_items.booking_id', 'left');
//                        $this->TF->db->where_not_in('booking_events.status', array('cancelled', 'no-show'));
//                        $this->TF->db->where('booking_events.facility_id', (int)$row['facility_id']);
//                        if ($this->event) $this->TF->db->where('booking_events.event_id != ', $this->event);
//                        $this->TF->db->where("'{$this->start}' <= DATE_ADD(end_dt, INTERVAL 1 MINUTE) AND '{$this->end}' >= start_dt");
//                        $row1 = $this->TF->db->get()->row_array();
//                        $existing_accomodation = intval($row1['existing_accomodation']);
//
//                        if ($existing_accomodation >= $max_accomodation) {
//                            $this->exclude_facilities[] = (int)$row['facility_id'];
//                            $this->errors[] = 'The room you selected is no longer available at booking time.';
//                        }
                    }

                }
            }

            return true;
        }
        catch (Exception $exception) {
            throw $exception;
        }
    }

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

            $eventUsers = $event->getEventUsers();

            if (isset($eventData['EventUsers'])) {

                $savedEventUsers = new \Propel\Runtime\Collection\ObjectCollection();

                foreach ($eventData['EventUsers'] as $eventUser) {
                    $userData = new \TheFarm\Models\EventUser();
                    $userData->fromArray($eventUser);

                    if ($eventUsers->contains($userData)) {
                        $userData = $eventUsers->get($eventUsers->search($userData));
                        $userData->fromArray($eventUser);
                        $savedEventUsers->append($userData);
                    } else {
                        $event->addEventUser($userData);
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
            $eventArr['EventUsers'] = $event->getEventUsers()->toArray();
            $eventArr['Booking'] = $event->getBooking()->toArray();
            $eventArr['Booking']['Guest'] = $event->getBooking()->getContactRelatedByGuestId()->toArray();
            $eventArr['Item'] = $event->getItem()->toArray();
            $eventArr['Item']['Categories'] = $event->getItem()->getItemCategoriesJoinCategory()->toArray();

            return $eventArr;
        }
        catch (Exception $exception) {
            return $exception;
        }
    }

    public function get_event($eventId) {
        $event = \TheFarm\Models\BookingEventQuery::create()->findOneByEventId($eventId);
        $eventArr = $event->toArray();
        $eventArr['Item'] = $event->getItem()->toArray();
        $eventArr['Booking'] = $event->getBooking()->toArray();
        $eventArr['Booking']['Guest'] = $event->getBooking()->getContactRelatedByGuestId()->toArray();
        if ($event->getEventUsers()) $eventArr['EventUsers'] = $event->getEventUsers()->toArray();
        if ($event->getFacility()) $eventArr['Facility'] = $event->getFacility()->toArray();

        return $eventArr;
    }

    public function get_upcoming_events($categories, $locations, $eventStatus, $unAssignedEventOnly) {
        return $this->get_events(null, null, null, $categories, $locations, $eventStatus, true, 'P7D', $unAssignedEventOnly);
    }

    public function get_statuses() {
        $statuses = \TheFarm\Models\EventStatusQuery::create()->find();
        return $statuses->toArray();
    }

    public function get_events($start = null, $end = null, $guestId = null, $categories = [], $locations = [], $eventStatus = null, $upcoming = false, $upcomingThreshold = 'P7D', $unAssignedEventOnly = false) {

         $search = \TheFarm\Models\BookingEventQuery::create()->filterByIsActive(true);

         if ($guestId) {
             $search = $search->useBookingQuery()
                 ->filterByStatus('confirmed')
                 ->filterByGuestId($guestId)->endUse();
         }

         if ($categories) {
             $search = $search->useItemQuery()->useItemCategoryQuery()->filterByCategoryId($categories)->endUse()->endUse();
         }

         if ($unAssignedEventOnly) {
             $search = $search->useEventUserQuery(null, 'LEFT JOIN')->filterByEventId(null)->endUse();
         }

        if ($upcoming) {

            $start = new DateTime();
            $end = new DateTime();
            $end->add(new DateInterval($upcomingThreshold));

            $search = $search->filterByEndDate(['min' => $start->format('Y-m-d H:i:s'), 'max' => $end->format('Y-m-d H:i:s')]);
        }
        elseif ($start && $end) {
             $start = new DateTime($start);
             $end = new DateTime($end);
             $search = $search->filterByStartDate(['min' => $start->format('Y-m-d H:i:s'), 'max' => $end->format('Y-m-d H:i:s')]);
        }
        elseif ($start) {
             $search = $search->filterByStartDate($start);
        }


        $search = $search
            ->useBookingQuery()
                ->filterByStatus('confirmed')
                ->filterByIsActive(true)
                    ->useContactRelatedByGuestIdQuery()
                        ->filterByIsActive(true)
                    ->endUse()
            ->endUse();

         $search->orderByStartDate();

         $events = $search->find();
         $eventsArray = [];

         if ($events) {

             foreach ($events as $key => $event) {
                 $eventsArray[$key] = $event->toArray();
                 $eventsArray[$key]['Item'] = $event->getItem()->toArray();
                 $eventsArray[$key]['Item']['Categories'] = $event->getItem()->getItemCategoriesJoinCategory()->toArray();
                 $eventsArray[$key]['Booking'] = $event->getBooking()->toArray();
                 $eventsArray[$key]['Booking']['Guest'] = $event->getBooking()->getContactRelatedByGuestId()->toArray();

                 if ($event->getBooking()->getRoom()) {
                     $eventsArray[$key]['Booking']['Room'] = $event->getBooking()->getRoom()->toArray();
                 }


                 if ($event->getFacility()) {
                     $eventsArray[$key]['Facility'] = $event->getFacility()->toArray();
                 }

                 if ($event->getEventUsers()->count() > 0) {
                     $eventsArray[$key]['EventUsers'] = $event->getEventUsers()->toArray();
                 }
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