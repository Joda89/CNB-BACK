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
    
        $this->app['mails.service'] = $this->app->share(function () {
            return new Services\MailsService($this->app["db"]);
        });
        
        $this->app['cours.service'] = $this->app->share(function () {
            return new Services\CoursService($this->app["db"]);
        });
        
        $this->app['horaires.service'] = $this->app->share(function () {
            return new Services\HorairesService($this->app["db"]);
        });
        
        $this->app['courstype.service'] = $this->app->share(function () {
           return new Services\CoursTypeService($this->app["db"]); 
        });
        
        $this->app['lignes.service'] = $this->app->share(function () {
           return new Services\LignesService($this->app["db"]); 
        });
        
        $this->app['sceances.service'] = $this->app->share(function () {
           return new Services\SeancesService($this->app["db"]); 
        });
        
        $this->app['statuts.service'] = $this->app->share(function () {
           return new Services\StatutsService($this->app["db"]); 
        });
        
        $this->app['login.service'] = $this->app->share(function () {
           return new Services\LoginService($this->app["db"]); 
        });
        
        $this->app['sms.service'] = $this->app->share(function () {
           return new Services\SMSService(); 
        });
        
    }
}

