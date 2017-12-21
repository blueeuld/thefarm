<?php

namespace TheFarm\App;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TheFarm\Services\BookingApi;

class BookingController implements ControllerProviderInterface {


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
        $controllers->get('/Bookings', [$this, 'getBookings']);
        return $controllers;
    }

    public function getBookings(Request $request) {
        $userApi = new BookingApi();
        $users = $userApi->searchBookings();
        return Response::create($users->toJSON(), 200, ['Content-Type' => 'application/json']);
    }
}