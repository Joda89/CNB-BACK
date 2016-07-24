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
        
        return new JsonResponse(null);
    }
    
    public function get($id)
    {
        
        //idem
        return new JsonResponse($user);
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
        return json_decode($request->request->get("user"),true);
    }
}
