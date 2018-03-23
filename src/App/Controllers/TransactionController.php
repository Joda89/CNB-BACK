<?php
namespace App\Controllers;
use Silex\ControllerProviderInterface;
use Silex\Application;

class TransactionController implements ControllerProviderInterface
{

    private $app;
    
    public function __construct($app)
    {
        $this->connect($app);
        $this->app = $app;
    }

     public function beginTransaction()
    {
        $this->app["db"]->beginTransaction();
        
    }
    
    public function endTransaction()
    {
        $this->app["db"]->commit();
    }

    public function connect(Application $app) {
        $app->before("transaction.controller:beginTransaction");
        $app->after("transaction.controller:endTransaction");
    }
}
