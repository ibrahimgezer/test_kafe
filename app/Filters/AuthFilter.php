<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $router = service('router');
        $controller = $router->controllerName();
        //$method = $router->methodName();
        $allowedControllers = ['AuthController', 'QrMenuController','CartController','OrderController'];

        foreach ($allowedControllers as $allowedController) {
            if (str_contains($controller, $allowedController)) {
                return true;
            }
        }

        if (!session()->get("loggedUser")) {
            return redirect()->to('/auth');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // After filter logic
    }
}