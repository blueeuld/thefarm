<?php

class FacilityApi {

    public function search_facilities($location) {

        $search = \TheFarm\Models\FacilityQuery::create()
            ->filterByStatus(true);

        if ($location)
            $search = $search->filterByLocationId($location);

        $facilities = $search->find();

        if ($facilities) {
            return $facilities->toArray();
        }

        return [];
    }

    public function get_facility() {

    }

}