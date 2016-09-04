<?php
namespace App\Controllers;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Request;
use Silex\ControllerProviderInterface;
use Silex\Application;


class LoginController implements ControllerProviderInterface
{
    const VALIDATE_CREDENTIALS = '/validateCredentials';
    const TOKEN_HEADER_KEY     = 'X-Token';
    const TOKEN_REQUEST_KEY    = '_token';
    
    private $baseRoute;
    private $pathAuthRequired = array();
    
    public function setBaseRoute($baseRoute)
    {
        $this->baseRoute = $baseRoute;
        return $this;
    }
    public function connect(Application $app)
    {
        $this->setUpMiddlewares($app);
        return $this->extractControllers($app);
    }
    public function addPathRequired($path)
    {
        $this->pathAuthRequired[] = $path;
    }
    
    private function extractControllers(Application $app)
    {
        $controllers = $app['controllers_factory'];
        $controllers->get(self::VALIDATE_CREDENTIALS, function (Request $request) use ($app) {
            $user   = $request->get('user');
            $pass   = $request->get('pass');
            $status = $app['login.service']->validateCredentials($user, $pass);
            return $app->json([
                'status' => $status,
                'info'   => $status ? ['token' => $app['login.service']->getNewTokenForUser($user)] : []
            ]);
        });
        return $controllers;
    }
    private function setUpMiddlewares(Application $app)
    {
        $app->before(function (Request $request) use ($app) {
            if ($this->isAuthRequiredForPath($request->getPathInfo(),$request->getMethod())) {
                if (!$this->isValidTokenForApplication($app, $this->getTokenFromRequest($request))) {
                    throw new AccessDeniedHttpException('Access Denied');
                }
            }
        });
    }
    private function getTokenFromRequest(Request $request)
    {
        return $request->headers->get(self::TOKEN_HEADER_KEY, $request->get(self::TOKEN_REQUEST_KEY));
    }
    private function isAuthRequiredForPath($path,$method)
    {
        $retour = in_array($path, [$this->baseRoute . self::VALIDATE_CREDENTIALS]);
        
        foreach ($this->pathAuthRequired as $key => $item)
        {
            if(in_array($path, [$this->baseRoute . $item['path']]))
            {
                if($item['method'] == $method )
                {
                    $retour = $retour || true ;
                }
            }
        }  
        
        return $retour ;
    }
    private function isValidTokenForApplication(Application $app, $token)
    {
        return $app['login.service']->validateToken($token);
    }
}