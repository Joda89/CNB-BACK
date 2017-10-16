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
    protected $mailsService;

    public function __construct($usersService,$adressesService,$phonesService,$mailsService)
    {
        $this->usersService = $usersService;
        $this->adressesService = $adressesService;
        $this->phonesService = $phonesService;
        $this->mailsService = $mailsService;
    }

    public function getAll()
    {
        $users = $this->usersService->getAll();
        
        foreach ($users as $key => $value){
            $users[$key]['adresses'] = $this->adressesService->get($value['id']);
            $users[$key]['phones'] = $this->phonesService->get($value['id']);
            $users[$key]['mails'] = $this->mailsService->get($value['id']);
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
        // retrait de l'adresse pour enregistrement separé
        $userAdresses = $user['adresses'];
        unset($user['adresses']);
        
        // retrait de telephone pour enregistrement separé
        $userPhones = $user['phones'];
        unset($user['phones']);
        
        // retrait du mail pour enregistrement separé
        $userMail = $user['mail'];
        unset($user['mail']);
        
        // enregistrement de l'user seul
        $userId = new JsonResponse(array(
            "id" => $this->usersService->save($user)
        ));
        
        // enregistrement de son adresse
        $userAdresses['id'] = $userId;
        $this->adressesServices->save($userAdresses);
        
        // enregistrement de son telephone
        $userPhones['id'] = $userId;
        $this->phonesServices->save($userPhones);
        
        // enregistrement de son mail
        $userMail['id'] = $userId;
        $this->mailsServices->save($userMail);
        
        // renvoi de l'id de l'user
        return userId;
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
        return json_decode($request->get("user"),true);
    }
    
    public function getPathAuthRequired()
    {
        //return array("path" => "/users","method" => "GET");
    }
    
    public function setRoute($controllers)
    {
        $controllers->get('/users', "users.controller:getAll");
        $controllers->get('/user/{id}', "users.controller:get");
        $controllers->post('/user', "users.controller:save");
        $controllers->put('/user/{id}', "users.controller:update");
        $controllers->delete('/user/{id}', "users.controller:delete");
    }
}
