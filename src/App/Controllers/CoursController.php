<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class CoursController
{

    protected $coursService;
    protected $usersService;
    protected $lignesService;

    public function __construct($coursService,$usersService,$lignesService)
    {
        $this->coursService = $coursService;
        $this->usersService = $usersService;
        $this->lignesService = $lignesService;
    }

    public function getAll()
    {
        //Chercher a partir de courType
        //puis cour_horaire
        //puis cours
        
        $cours = $this->coursService->getAll();
        
        return new JsonResponse($cours);
    }
    
    public function get($id)
    {
        
        //idem
        return new JsonResponse(null);
    }

    public function save(Request $request)
    {
        $user = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->usersService->save($user)));

    }

    public function update($id, Request $request)
    {
        $user = $this->getDataFromRequest($request);
        $this->usersService->update($id, $user);
        return new JsonResponse($user);

    }

    public function delete($id)
    {

        return new JsonResponse($this->usersService->delete($id));

    }

    public function getDataFromRequest(Request $request)
    {
        return json_decode($request->request->get("cour"),true);
    }
    
        public function getPathAuthRequired()
    {
        //return array("path" => "/users","method" => "GET");
    }
    
    public function setRoute($controllers)
    {
        $controllers->get('/cours', "cours.controller:getAll");
        $controllers->get('/cour/{id}', "cours.controller:get");
        $controllers->post('/cour', "cours.controller:save");
        $controllers->put('/cour/{id}', "cours.controller:update");
        $controllers->delete('/cour/{id}', "cours.controller:delete");
    }
}
