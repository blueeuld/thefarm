<?php

class Event {

    var $eventId;
    var $unAssignedEventOnly;
    var $guestId;
    var $categories;
    var $locations;
    var $upcoming;
    var $upcomingThreshold;

    public function __construct($params)
    {
        foreach ($params as $key => $param) {
            $this->$key = $param;
        }
    }

    public function get_events() {

         $search = \TheFarm\Models\BookingEventQuery::create();

         if ($this->eventId) {
             $search = $search->filterByEventId($this->eventId);
         }

         if ($this->guestId) {
             $search = $search->useBookingItemQuery()->useBookingQuery()->filterByGuestId($this->guestId)->endUse()->endUse();
         }

         if ($this->categories) {
             $search = $search->useBookingItemQuery()->useItemQuery()->useItemCategoryQuery()->filterByCategoryId($this->categories)->endUse()->endUse()->endUse();
         }

         if ($this->unAssignedEventOnly) {
             $search = $search->useBookingEventUserQuery(null, 'LEFT JOIN')->filterByEventId(null)->endUse();
         }

        if ($this->upcoming) {

            $start = new DateTime();
            $end = new DateTime();
            $end->add(new DateInterval($this->upcomingThreshold));

            $search = $search->filterByEndDt(['min' => $start->format('Y-m-d H:i:s'), 'max' => $end->format('Y-m-d H:i:s')]);
//
//            $this->start = $start->format('Y-m-d H:i:s');
//            $this->end = $end->format('Y-m-d H:i:s');
//            $this->TF->db->where("tf_booking_events.end_dt BETWEEN '{$this->start}' AND '{$this->end}'");
        }


         $search = $search->useBookingItemQuery()->useBookingQuery()->filterByIsActive(true)->endUse()->endUse();

         $search->orderByStartDt();

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
                $eventsArray[$key]['Staff'] = $event->getBookingEventUsersJoinContact()->toArray();
             }

         }
         return $eventsArray;
    }

}