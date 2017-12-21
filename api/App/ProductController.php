<?php

namespace TheFarm\App;

use Silex\Application;
use Silex\ControllerCollection;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TheFarm\Services\ProductApi;

class ProductController implements ControllerProviderInterface {


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
        $controllers->get('/Products', [$this, 'getProducts']);
        return $controllers;
    }

    public function getProducts(Request $request) {
        $userApi = new ProductApi();
        $users = $userApi->searchProducts($request->get('categoryId'));
        return Response::create($users->toJSON(), 200, ['Content-Type' => 'application/json']);
    }

}