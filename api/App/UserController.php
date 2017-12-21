<?php

namespace TheFarm\App;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TheFarm\Services\UserApi;

class UserController implements ControllerProviderInterface {


    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];
        $controllers->get('/Users', [$this, 'getUsers']);
        $controllers->get('/Guests', [$this, 'getGuests']);
        $controllers->post('/ValidateUser', [$this, 'validateUser']);
        return $controllers;
    }

    public function getGuests(Request $request) {
        $userApi = new UserApi();
        $users = $userApi->searchGuests();
        return Response::create($users->toJSON(), 200, ['Content-Type' => 'application/json']);
    }

    public function getUsers(Request $request) {
        $userApi = new UserApi();
        $users = $userApi->getUsers();
        return Response::create($users->toJSON(), 200, ['Content-Type' => 'application/json']);
    }

    public function validateUser(Request $request) {
        $userApi = new UserApi();
        $validatedUser = $userApi->validateUser($request->get('userName'), $request->get('password'));
        return Response::create($validatedUser->toJSON(), 200, ['Content-Type' => 'application/json']);
    }


}