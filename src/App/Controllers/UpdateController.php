<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UpdateController
{

    protected $updateService;

    public function __construct($updateService)
    {
        $this->updateService = $updateService;
    }

    public function getAll()
    {
        //Chercher a partir de courType
        //puis cour_horaire
        //puis cours
        $this->updateService->testImport(ROOT_PATH . '/resources/sql/full/cnb.sql');
        //$stmt->execute();
        //$cours = $this->coursService->getAll();
        
        return 'test' ;
    }
    
    public function getPathAuthRequired()
    {
        //return array("path" => "/update","method" => "GET");
    }
    
    public function setRoute($controllers)
    {
        $controllers->get('/update', "update.controller:getAll");
    }
}
