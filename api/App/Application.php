<?php

namespace TheFarm\App;

use Propel\Silex\PropelServiceProvider;
use Silex\Application as SilexApplication;
use Silex\Provider\MonologServiceProvider;

class Application extends SilexApplication
{
    public function __construct($env)
    {
        parent::__construct();
        $app = $this;

        $app->register(new PropelServiceProvider(), [
            'propel.config_file' => 'Data/generated-conf/config.php'
        ]);

        $app->register(new MonologServiceProvider(), [
            'monolog.logfile' => __DIR__.'/../log/silex.log'
        ]);

        $app->mount('/user-api', new UserController());
        $app->mount('/product-api', new ProductController());
        $app->mount('/booking-api', new BookingController());
    }
}