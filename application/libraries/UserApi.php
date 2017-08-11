<?php

class UserApi {

    function save_user($userData) {

        if ($userData['ContactId']) {
            $user = \TheFarm\Models\ContactQuery::create()->findOneByContactId($userData['ContactId']);
            $user->fromArray($userData);
        }
        else {
            $user = new \TheFarm\Models\Contact();
            $user->fromArray($userData);
        }

        $user->save();
        return $user->toArray();

    }

    function get_user($userId) {

        $user = \TheFarm\Models\ContactQuery::create()->findOneByContactId($userId);

        $userArr = $user->toArray();
        if ($user->getUserWorkPlanTimes()) {
            $userArr['UserWorkPlanTimes'] = $user->getUserWorkPlanTimes()->toArray();
        }
        if ($user->getBookingsRelatedByGuestId()) {
            $bookings = $user->getBookingsRelatedByGuestId();
            $bookingsArr = $bookings->toArray();
//            foreach ($bookings as $key => $booking) {
//                $userArr['Bookings'][$key]['Forms'] = $booking->getBookingF
//            }
            $userArr['Bookings'] = $bookingsArr;
        }

        if ($user->getUser()) {
            $userArr['User'] = $user->getUser()->toArray();
            $userArr['User']['Group'] = $user->getUser()->getGroup()->toArray();
        }

        if ($user->getItemsRelatedUsers()) {
            $userArr['UserItems'] = $user->getItemsRelatedUsersJoinItem()->toArray();
        }

        return $userArr;
    }

    function get_users($providersOnly = false, $locations = [], $relatedItemId = null, $availableProvidersOnly = null, $startDateTime = null, $endDateTime = null, $auditUsersOnly = false) {
        $search = \TheFarm\Models\ContactQuery::create()
            ->filterByIsActive(true);

        if ($providersOnly) {
            $search = $search->useUserQuery()->useGroupQuery()->filterByIncludeInProviderList('y')->endUse()->endUse();

            if ($availableProvidersOnly && !is_null($startDateTime) && !is_null($endDateTime)) {
                $search = $search->useUserWorkPlanTimeQuery('work_plan')->where("(work_plan.start_date BETWEEN '".$startDateTime."' AND '".$endDateTime."') OR (work_plan.end_date BETWEEN '".$startDateTime."' AND '".$endDateTime."') OR ('".$startDateTime."' BETWEEN work_plan.start_date AND work_plan.end_date)")->endUse();
            }
        }

        if ($auditUsersOnly) {
            $search = $search->useUserQuery()->useGroupQuery()->filterByIncludeInAuditList('y')->endUse()->endUse();
        }

        if ($locations) {
            $search = $search->useUserQuery()->filterByLocationId($locations)->endUse();
        }

        if (!is_null($relatedItemId)) {
            $search = $search->useItemsRelatedUserQuery()->filterByItemId($relatedItemId)->endUse();
        }

        $users = $search->find();
        $userArr = [];
        if ($users) {

            foreach ($users as $key => $user) {
                $userArr[$key] = $user->toArray();
                if ($providersOnly) {
                    $userArr[$key]['UserWorkPlanTimes'] = $user->getUserWorkPlanTimes()->toArray();
                }
            }
        }

        return $userArr;
    }

    function delete_user($contactId) {

        $user = \TheFarm\Models\ContactQuery::create()->findOneByContactId($contactId);
        $user->setIsActive(false);
        $user->save();
        return $user->toArray();

    }

    function validate_user($username, $hashedPassword) {

        $search = \TheFarm\Models\ContactQuery::create()
                ->useUserQuery()->filterByUsername($username)->filterByPassword($hashedPassword)
            ->endUse()->findOne();

        if ($search) {
            $userArr = $search->toArray();
            $userArr['User'] = $search->getUser()->toArray();
            $userArr['User']['Group'] = $search->getUser()->getGroup()->toArray();
            return $userArr;
        }

        return null;

    }

    function get_job_titles() {
        $jobTitles = \TheFarm\Models\PositionQuery::create()->orderByPositionOrder()->find();

        return $jobTitles->toArray();
    }
}