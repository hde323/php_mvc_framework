<?php

namespace src;

/**
 * Router class for declaring and matching routes in a PHP application.
 *
 * Allows declaring routes that match specific HTTP methods like GET, POST, etc.
 * Also allows matching routes to multiple methods.
 * Routes are stored in a private $routes property.
 *
 * Provides methods for declaring routes for each HTTP method:
 * - get()
 * - post()
 * - patch()
 * - delete()
 * - head()
 * - put()
 *
 * match() declares a route that accepts multiple methods.
 *
 * resolve() matches a request path and method to a route.
 */


class Router
{
    private static $routes = [];

    //a function that declares a route that only accepts a get request
    public function Get(string $path, array $action)
    {
        self::$routes[$path] = [
            "methods" => "GET",
            "action" => $action
        ];
    }
    //a function that declares a route that only accepts a post request
    public function Post(string $path, array $action)
    {
        self::$routes[$path] = [
            "methods" => "POST",
            "action" => $action
        ];
    }
    //a function that declares a route that only accepts a patch request
    public function Patch(string $path, array $action)
    {
        self::$routes[$path] = [
            "methods" => "PATCH",
            "action" => $action
        ];
    }
    //a function that declares a route that only accepts a delete request
    public function Delete(string $path, array $action)
    {
        self::$routes[$path] = [
            "methods" => "DELETE",
            "action" => $action
        ];
    }
    //a function that declares a route that only accepts a head request
    public function Head(string $path, array $action)
    {
        $this->routes[$path] = [
            "methods" => "HEAD",
            "action" => $action
        ];
    }
    //a function that declares a route that only accepts a head request
    public function Put(string $path, array $action)
    {
        $this->routes[$path] = [
            "methods" => "PUT",
            "action" => $action
        ];
    }

    /*
    * function that declares a route that accepts requests only from the two defined methods
    * if the function doesnt get an array with two methods in the parameters it automaticly sets
    * the allowed request method to get.
    */
    public function Abort(int $code, string $message)
    {
        if($_ENV["DEBUG"] === true)
        {
            throw new \Exception($message, $code);
        }else{
            http_response_code($code);
            Kernel::Error($code);
            return;
        }

    }

    public function Match(string $path, array $methods, callable $action)
    {
        if (count($methods) == 2) {
            self::$routes[$path] = [
                "methods" => $methods,
                "action" => $action
            ];
        } else {
            $this->Abort(500, "Invalid number of methods, the match function only accepts two methods");
        }
    }

    public function Resolve(string $path)
    {
        if (array_key_exists($path, self::$routes)) {
            $Request_Method = $_SERVER['REQUEST_METHOD'];
            $route = self::$routes[$path];

            if (is_array(self::$routes[$path]["methods"])) {
                if (in_array($Request_Method, $this->routes[$path]["methods"])) {
                    $action = $route["action"];
                    if (is_callable($action)) {
                        call_user_func($action);
                        return;
                    } else {
                        return $this->Abort(500,"Invalid action, the action associated with the route is not callable");
                    }
                }
            } else if (self::$routes[$path]["methods"] == $Request_Method) {
                $action = $route["action"];
                if (is_callable($action)) {
                    call_user_func($action);
                    return;
                } else {
                   return $this->Abort(500,"Invalid action, the action associated with the route is not callable");
                }
            } else {
                return $this->Abort(405, "Method not allowed, this route only accepts the following methods: ". self::$routes[$path]["methods"]);
            }
        } else {
            return $this->Abort(404, "Not found,the route you are looking for does not exist");
        }
    }

}
