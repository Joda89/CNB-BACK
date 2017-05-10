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
        $this->app['login.controller'] = $this->app->share(function () {
            return new Controllers\LoginController($this->app);
        });
        
        $this->app['users.controller'] = $this->app->share(function () {
            return new Controllers\UsersController($this->app['users.service'],$this->app['adresses.service'],$this->app['phones.service'],$this->app['mails.service']);
        });
        
        $this->app['cours.controller'] = $this->app->share(function () {
            return new Controllers\CoursController($this->app['cours.service'],$this->app['users.service'],$this->app['lignes.service']);
        });
        
        $this->app['courstype.controller'] = $this->app->share(function () {
            return new Controllers\CoursTypeController($this->app['courstype.service'],$this->app['horaires.service'],$this->app['cours.service']);
        });
        
        $this->app['sms.controller'] = $this->app->share(function () {
            return new Controllers\SmsController($this->app['sms.service']);
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
        
        //Cours
        $this->app['cours.controller']->setRoute($api);
        $this->app['login.controller']->addPathRequired( $this->app['cours.controller']->getPathAuthRequired());
        
        //Cours_type
        $this->app['courstype.controller']->setRoute($api);
        $this->app['login.controller']->addPathRequired( $this->app['courstype.controller']->getPathAuthRequired());
        
        
        //Sms
        $this->app['sms.controller']->setRoute($api);
        $this->app['login.controller']->addPathRequired( $this->app['sms.controller']->getPathAuthRequired());
        
        

        $this->app['login.controller']->setBaseRoute($this->app["api.endpoint"].'/'.$this->app["api.version"]);
        $this->app->mount($this->app["api.endpoint"].'/'.$this->app["api.version"], $api);
    }
}

