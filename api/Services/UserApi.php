<?php

namespace TheFarm\Services;

use TheFarm\Models\ContactQuery;
use TheFarm\Models\UserQuery;

class UserApi {

    public function getUsers() {
        return UserQuery::create()->find();
    }

    public function searchGuests() {
        return ContactQuery::create()->find();
    }

    public function validateUser($userName, $password) {
        if (!$userName || !$password) {
            throw new \Exception('authenticate: userName and password are required.');
        }
        return UserQuery::create()->findOneByUsername($userName);
    }
}