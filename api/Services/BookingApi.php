<?php

namespace TheFarm\Services;

use TheFarm\Models\BookingQuery;

class BookingApi {

    public function searchBookings() {
        $search = BookingQuery::create();
        $result = $search->find();

        foreach ($result as $row) {
            $row->getPackage();
            $row->getStatus();
            $row->getEvents();
        }

        return $result;
    }
}