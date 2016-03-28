<?php

namespace App;

use Silex\Application;

class ServicesLoader
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function bindServicesIntoContainer()
    {
        $this->app['users.service'] = $this->app->share(function () {
            return new Services\UsersService($this->app["db"]);
        });
        
        $this->app['adresses.service'] = $this->app->share(function () {
            return new Services\AdressesService($this->app["db"]);
        });
        
        $this->app['phones.service'] = $this->app->share(function () {
            return new Services\PhonesService($this->app["db"]);
        });
    }
}

