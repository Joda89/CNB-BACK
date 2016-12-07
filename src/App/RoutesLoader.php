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
        
        $this->app['login.controller'] = $this->app->share(function () {
            return new Controllers\LoginController($this->app);
        });
    }

    public function bindRoutesToControllers()
    {
        $api = $this->app['controllers_factory'];
        //Login
        $this->app['login.controller']->setRoute($api);
        
        //Users
        $this->app['users.controller']->setRoute($api);
        
        $this->app['login.controller']->addPathRequired( $this->app['users.controller']->getPathAuthRequired());

        $this->app['login.controller']->setBaseRoute($this->app["api.endpoint"].'/'.$this->app["api.version"]);
        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}

