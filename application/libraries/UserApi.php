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

        if (isset($userData['ProviderSchedules'])) {
            $this->save_user_work_times($userData['ProviderSchedules'], $user->getContactId());
        }

        $user->save();
        return $user->toArray();

    }

    function save_user_work_times($timeData, $contactId) {
        foreach ($timeData as $time) {
            $userWorkPlanTime = \TheFarm\Models\ProviderScheduleQuery::create()
                ->filterByContactId($time['ContactId'])
                ->filterByStartDate($time['StartDate'])
                ->findOne();
            if ($userWorkPlanTime) {
                $userWorkPlanTime->fromArray($time);
            }
            else {
                $userWorkPlanTime = new \TheFarm\Models\UserWorkPlanTime();
                $userWorkPlanTime->fromArray($time);
            }
            $userWorkPlanTime->save();
        }

        // Delete is_working = false;
        \TheFarm\Models\ProviderScheduleQuery::create()
            ->filterByContactId($contactId)
            ->filterByIsWorking(false)
            ->delete();
    }

    function get_user($userId) {

        $user = \TheFarm\Models\ContactQuery::create()->findOneByContactId($userId);

        $userArr = $user->toArray();
        if ($user->getProviderSchedules()) {
            $userArr['ProviderSchedules'] = $user->getProviderSchedules()->toArray();
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
        }
        elseif ($availableProvidersOnly && !is_null($startDateTime) && !is_null($endDateTime)) {
            $search = $search->useProviderScheduleQuery()->where("((start_date BETWEEN '".$startDateTime."' AND '".$endDateTime."') OR (end_date BETWEEN '".$startDateTime."' AND '".$endDateTime."') OR ('".$startDateTime."' BETWEEN start_date AND end_date))")->endUse();
        }
        elseif ($availableProvidersOnly && !is_null($startDateTime)) {
            $search = $search->useUserWorkPlanDayQuery()->filterByWorkCodeCd(['OFF', 'VL', 'OS'])->filterByDate($startDateTime)->endUse();
        }

        if ($auditUsersOnly) {
            $search = $search->useUserQuery()->useGroupQuery()->filterByIncludeInAuditList('y')->endUse()->endUse();
        }

        if ($locations) {
            $search = $search->useUserQuery()->filterByLocationId($locations)->endUse();
        }

        if (!is_null($relatedItemId) && $relatedItemId) {
            $search = $search->useItemsRelatedUserQuery()->filterByItemId($relatedItemId)->endUse();
        }

        if ($availableProvidersOnly) {
            $search = $search->distinct();
        }

        $users = $search->find();
        $userArr =$users->toArray();
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