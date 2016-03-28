<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UsersController
{

    protected $usersService;
    protected $adressesService;
    protected $phonesService;

    public function __construct($usersService,$adressesService,$phonesService)
    {
        $this->usersService = $usersService;
        $this->adressesService = $adressesService;
        $this->phonesService = $phonesService;
    }

    public function getAll()
    {
        $users = $this->usersService->getAll();
        
        foreach ($users as $key => $value){
            $users[$key]['adresses'] = $this->adressesService->get($value['id']);
            $users[$key]['phones'] = $this->phonesService->get($value['id']);
        }
        return new JsonResponse($users);
    }
    
    public function get($id)
    {
        $user = $this->usersService->get($id);
        $user['adresses'] = $this->adressesService->get($user['id']);
        $user['phones'] = $this->phonesService->get($user['id']);
        
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
