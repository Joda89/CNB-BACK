<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SmsController
{

    private $smsService;

    public function __construct($smsService)
    {
        $this->smsService = $smsService;
    }

    public function getSmsHistorique()
    {
        
        $config['applicationKey'] = "7PtZyBzudI6Rsiqv";
        $config['applicationSecret'] = "OuPxf53Nc1mDVBGH8DR0jmCl33yLksbI";
        $config['consumerKey'] = "bAcNaQOSiUd3QtP7ObV2vgyn9VD2SGm3";
        $config['endpoint'] = 'ovh-eu';
        
        $this->smsService->createService($config);
        $messages = $this->smsService->getSmsRestant();
        
        return new JsonResponse($messages);
    }

    public function getDataFromRequest(Request $request)
    {
        return json_decode($request->request->get("sms"),true);
    }
    
        public function getPathAuthRequired()
    {
        //return array("path" => "/users","method" => "GET");
    }
    
    public function setRoute($controllers)
    {
        $controllers->get('/sms', "sms.controller:getSmsHistorique");
        //$controllers->get('/sms/{id}', "sms.controller:get");
        //$controllers->post('/sms', "sms.controller:save");
        //$controllers->delete('/sms/{id}', "sms.controller:delete");
    }
}
