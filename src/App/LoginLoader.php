<?php

namespace App;

use Silex\Application;


class LoginLoader
{
    public static function mountProviderIntoApplication($route, Application $app)
    {
        $app->register(new Services\LoginService());
        $app->mount($route, (new Controllers\LoginController())->setBaseRoute($route));
    }
}