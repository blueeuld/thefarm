<?php

class UserApi {

    function get_users($providersOnly = false, $locations = []) {
        $search = \TheFarm\Models\ContactQuery::create()
            ->filterByIsActive(true);

        if ($providersOnly) {
            $search = $search->useUserQuery()->useGroupQuery()->filterByIncludeInProviderList('y')->endUse()->endUse();
        }

        if ($locations) {
            $search = $search->useUserQuery()->filterByLocationId($locations);
        }

        $search = $search->find();

        return $search->toArray();
    }

    function delete_user($contactId) {

        $user = \TheFarm\Models\ContactQuery::create()->findOneByContactId($contactId);
        $user->setIsActive(false);
        $user->save();
        return $user->toArray();

    }

}