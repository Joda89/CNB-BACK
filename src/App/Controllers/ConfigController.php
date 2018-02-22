<?php
/**
 * Created by IntelliJ IDEA.
 * User: mathieu
 * Date: 2/17/18
 * Time: 3:50 PM
 */

namespace App\Controllers;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ConfigController
{

    protected $configService;

    public function __construct($configService)
    {
        $this->configService = $configService;
    }

    public function getAll()
    {
        $config = $this->configService->getAll()    ;
        return new JsonResponse($config);
    }

    public function get($id)
    {
       $config = $this->configService->get($id);
        return new JsonResponse($config);
    }

    public function save(Request $request)
    {
        $config = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->configService->save($config)));
    }

    public function update($id, Request $request)
    {
        $config = $this->getDataFromRequest($request);
        $this->configService->update($id, $config);
        return new JsonResponse($config);
    }

    public function delete($id)
    {

        return new JsonResponse($this->configService->delete($id));

    }

    public function getDataFromRequest(Request $request)
    {
        return json_decode($request->get("config"),true);
    }

    public function getPathAuthRequired()
    {
        //return array("path" => "/config","method" => "GET");
    }

    public function setRoute($controllers)
    {
        $controllers->get('/config', "config.controller:getAll");
        $controllers->get('/config/{id}', "config.controller:get");
        $controllers->post('/config', "config.controller:save");
        $controllers->put('/config/{id}', "config.controller:update");
        $controllers->delete('/config/{id}', "config.controller:delete");
    }
}
