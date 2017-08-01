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

         $search = \TheFarm\Models\BookingEventsQuery::create();

         if ($this->eventId) {
             $search = $search->filterByEventId($this->eventId);
         }

         if ($this->guestId) {
             $search = $search->useBookingItemsQuery()->useBookingsQuery()->filterByGuestId($this->guestId)->endUse()->endUse();
         }

         if ($this->categories) {
             $search = $search->useBookingItemsQuery()->useItemsQuery()->useItemCategoriesQuery()->filterByCategoryId($this->categories)->endUse()->endUse()->endUse();
         }

         if ($this->unAssignedEventOnly) {
             $search = $search->useBookingEventUsersQuery(null, 'LEFT JOIN')->filterByEventId(null)->endUse();
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


         $search = $search->useBookingItemsQuery()->useBookingsQuery()->filterByIsActive(true)->endUse()->endUse();

         $search->orderByStartDt();

         $events = $search->find();
         $eventsArray = [];

         foreach ($events as $key => $event) {
             $eventsArray[$key] = $event->toArray();
             if ($event->getBookingItems()) {
                 $eventsArray[$key]['BookingItem'] = $event->getBookingItems()->toArray();
                 $eventsArray[$key]['BookingItem']['Item'] = $event->getBookingItems()->getItems()->toArray();
                 $eventsArray[$key]['BookingItem']['Item']['Categories'] = $event->getBookingItems()->getItems()->getItemCategoriessJoinCategories()->toArray();
                 $eventsArray[$key]['BookingItem']['Booking'] = $event->getBookingItems()->getBookings()->toArray();
                 $eventsArray[$key]['BookingItem']['Booking']['Guest'] = $event->getBookingItems()->getBookings()->getContactRelatedByGuestId()->toArray();
             }

             if ($event->getFacilities()) {
                 $eventsArray[$key]['Facility'] = $event->getFacilities()->toArray();
             }

             if ($event->getBookingEventUserss()->count() > 0) {
                $eventsArray[$key]['Staff'] = $event->getBookingEventUserssJoinContact()->toArray();
             }

         }
         return $eventsArray;
    }

}