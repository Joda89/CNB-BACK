<?php

namespace App;

use Silex\Application;

class RoutesLoader
{
    private $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    private function instantiateControllers()
    {
        $this->app['users.controller'] = $this->app->share(function () {
            return new Controllers\UsersController($this->app['users.service'],$this->app['adresses.service'],$this->app['phones.service']);
        });
    }

    public function bindRoutesToControllers()
    {
        $loginControleur = new Controllers\LoginController() ;
        
        $api = $loginControleur->connect($this->app) ;
        
        //Users
        $api->get('/users', "users.controller:getAll");
        $api->get('/users/{id}', "users.controller:get");
        $api->post('/users', "users.controller:save");
        $api->put('/users/{id}', "users.controller:update");
        $api->delete('/users/{id}', "users.controller:delete");
        $loginControleur->addPathRequired( $this->app['users.controller']->getPathAuthRequired());

        $loginControleur->setBaseRoute($this->app["api.endpoint"].'/'.$this->app["api.version"]);
        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}

