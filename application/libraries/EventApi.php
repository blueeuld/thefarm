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

}