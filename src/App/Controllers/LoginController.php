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
    private $app;
    
    public function __construct($app)
    {
        $this->connect($app);
        $this->app = $app;
    }
    
    public function setBaseRoute($baseRoute)
    {
        $this->baseRoute = $baseRoute;
    }
    public function connect(Application $app)
    {
        $this->setUpMiddlewares($app);
    }
    public function addPathRequired($path)
    {
        $this->pathAuthRequired[] = $path;
    }
    
    public function setRoute($controllers)
    {
        $controllers->get(self::VALIDATE_CREDENTIALS, function (Request $request) {
            $user   = $request->get('user');
            $pass   = $request->get('pass');
            $status = $this->app['login.service']->validateCredentials($user, $pass);
            return $this->app->json([
                'status' => $status,
                'info'   => $status ? ['token' => $this->app['login.service']->getNewTokenForUser($user)] : []
            ]);
        });
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
        $retour = false ;

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