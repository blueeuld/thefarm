<?php

class BookingApi {

    public function get_booking($bookingId) {
        $booking = \TheFarm\Models\BookingQuery::create()->findOneByBookingId($bookingId);

        $bookingArr = $booking->toArray();
        $bookingArr['Items'] = $booking->getBookingItemsJoinItem()->toArray();
        $bookingArr['Forms'] = [];
        if ($booking->getBookingAttachments())
            $bookingArr['Attachments'] = $booking->getBookingAttachments()->toArray();

        return $bookingArr;
    }

    public function search_bookings($date, $statusCd) {

        $search = \TheFarm\Models\BookingQuery::create();

        if ($date) {
            $search = $search->where(sprintf('\'%s\' BETWEEN FROM_UNIXTIME(tf_bookings.start_date) AND FROM_UNIXTIME(tf_bookings.end_date)', date('Y-m-d', strtotime($date))));
        }

        if ($statusCd) {
            $search = $search->filterByStatus($statusCd);
        }

        $search = $search->filterByGuestId(null, '<>');

        $search = $search->filterByIsActive(true);

        $bookings = $search->find();
        $bookingArr = [];

        if ($bookings) {
            foreach ($bookings as $key => $booking) {
                $bookingArr[$key] = $booking->toArray();
                if ($booking->getContactRelatedByGuestId()) {
                    $bookingArr[$key]['Guest'] = $booking->getContactRelatedByGuestId()->toArray();
                }
                if ($booking->getPackage()) {
                    $bookingArr[$key]['Package'] = $booking->getPackage()->toArray();
                }
            }
        }

        return $bookingArr;
    }

    public function save_booking($bookingData, $notifyGuest = false) {

        if ($bookingData['BookingId']) {

            $booking = \TheFarm\Models\BookingQuery::create()->findOneByBookingId($bookingData['BookingId']);
            $originalStatus = $booking->getStatus();

            $booking->fromArray($bookingData);
            $booking->setEditDate(now());
        }
        else {
            $booking = new \TheFarm\Models\Booking();
            $booking->fromArray($bookingData);
            $booking->setAuthorId(get_current_user_id());
            $booking->setEntryDate(now());

            $originalStatus = false;
        }

        if (isset($bookingData['Items'])) {
            $this->save_items($booking, $bookingData['Items']);
        }

        if (isset($bookingData['Attachments'])) {
            $this->save_attachments($booking, $bookingData['Attachments']);
        }

        if (isset($bookingData['Forms'])) {
            $this->save_forms($booking, $bookingData['Forms']);
        }

        $booking->save();

        $notify = false;
        $subject = '';
        $message = '';

        if ($originalStatus && $originalStatus !== 'confirmed' && $booking->getStatus() === 'confirmed') {
            $subject = 'Booking Confirmation';
            $message = 'Hi '.$booking->getContactRelatedByGuestId()->getFirstName().", \n\n\n".
                'This is to confirm your booking. '."\n\n".
                'Program : '.$booking->getTitle()."\n".
                'Date : '.date('m/d/Y', $booking->getStartDate()).' - '.date('m/d/Y', $booking->getEndDate())."\n\n".
                'Please login to your account to view your booking.'."\n\n".
                site_url();
            $notify = true;
        }
        else if ($originalStatus && $originalStatus !== 'completed' && $booking->getStatus()  === 'completed') {
            $subject = 'Booking Completed';
            $message = 'Hi '.$booking->getContactRelatedByGuestId()->getFirstName().", \n\n\n".
                'Thank you for booking with us. '."\n\n".
                site_url();
            $notify = true;
        }
        elseif (!$originalStatus) {
            $subject = 'Welcome to TheFarm';
            $message = 'Hi '.$booking->getContactRelatedByGuestId()->getFirstName().", \n\n\n".
                'Welcome to TheFarm. '."\n\n".
                'Please login to your account to verify your booking.'."\n\n".
                site_url('booking/verify/'.$booking->getBookingId());
            $notify = true;
        }

        if ($notify) {
            $emailApi = new EmailApi();
            $emailApi->sendEmail($subject, $message, $_SESSION['Email'], $booking->getContactRelatedByGuestId()->getEmail());

            $messageApi = new MessageApi();
            $messageApi->sendMessage($subject, $booking->getGuestId());
        }

        return $booking->toArray();

    }

    public function get_package_types() {
        $packageTypes = \TheFarm\Models\PackageTypeQuery::create()->find();

        return $packageTypes->toArray();
    }


    public function save_items(TheFarm\Models\Booking $booking, $items) {

        $bookingItems = $booking->getBookingItems();
        $savedEventUsers = new \Propel\Runtime\Collection\ObjectCollection();

        foreach ($items as $eventUser) {
            $userData = new \TheFarm\Models\BookingItem();
            $userData->fromArray($eventUser);

            if ($bookingItems->contains($userData)) {
                $userData = $bookingItems->get($bookingItems->search($userData));
                $userData->fromArray($eventUser);
                $savedEventUsers->append($userData);
            } else {
                $booking->addBookingItem($userData);
                $savedEventUsers->append($userData);
            }
        }

        foreach ($bookingItems as $eventUser) {
            if (!$savedEventUsers->contains($eventUser)) {
                $bookingItems->removeObject($eventUser);
                $eventUser->delete();
            }
        }
    }

    public function save_attachments(TheFarm\Models\Booking $booking, $attachments) {
        $bookingItems = $booking->getBookingAttachments();
        $savedEventUsers = new \Propel\Runtime\Collection\ObjectCollection();

        foreach ($attachments as $eventUser) {
            $userData = new \TheFarm\Models\BookingAttachment();
            $userData->fromArray($eventUser);

            if ($bookingItems->contains($userData)) {
                $userData = $bookingItems->get($bookingItems->search($userData));
                $userData->fromArray($eventUser);
                $savedEventUsers->append($userData);
            } else {
                $booking->addBookingAttachment($userData);
                $savedEventUsers->append($userData);
            }
        }

        foreach ($bookingItems as $eventUser) {
            if (!$savedEventUsers->contains($eventUser)) {
                $bookingItems->removeObject($eventUser);
                $eventUser->delete();
            }
        }
    }

    public function save_forms(TheFarm\Models\Booking $booking, $forms) {

    }

}