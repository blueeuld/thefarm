<?php

class Calendar extends CI_Controller {

    public function get_events() {

         $search = \TheFarm\Models\BookingEventQuery::create();
         $eventId = $this->input->get_post('eventId');
         $unAssignedEventOnly = filter_var($this->input->get_post('unAssignedEventOnly'), FILTER_VALIDATE_BOOLEAN);
         $guestId = $this->input->get_post('guestId');
         $categories = $this->input->get_post('categories');


         if ($eventId) {
             $search = $search->filterByEventId($eventId);
         }

         if ($guestId) {
             $search = $search->useBookingItemQuery()->useBookingQuery()->filterByGuestId($guestId)->endUse()->endUse();
         }

         if ($categories) {
             $search = $search->useBookingItemQuery()->useItemQuery()->useItemCategoryQuery()->filterByCategoryId($categories)->endUse()->endUse()->endUse();
         }

         if ($unAssignedEventOnly) {
             $search = $search->useBookingEventUserQuery(null, 'LEFT JOIN')->filterByEventId(null)->endUse();
         }


         $search = $search->useBookingItemQuery()->useBookingQuery()->filterByIsActive(true)->endUse()->endUse();

         $search->orderByStartDt();
         $search->limit(50);

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


         $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($eventsArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
         exit;
    }

}