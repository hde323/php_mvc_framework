<?php

namespace src;

class Kernel
{
    protected Router $Router;
    protected Response $Response;

    public function __construct()
    {
        require_once __DIR__ . '/../app/config/env.php';
        $this->Router = new Router($this);
        $this->Response = new Response();
        $URI = $_SERVER['REQUEST_URI'];
        $PARSED_URI = parse_url($URI);
        $PATH = $PARSED_URI['path'];
        $this->Router->resolve($PATH);
    }

    public static function Error(int $code)
    {
        $msg = "";
        if($code !== 200)
        {
            switch ($code)
            {
                case 404: $msg = "Page not found"; break;
                case 405: $msg = "Method not allowed"; break;
                case 500: $msg = "Internal server error"; break;
                default: $msg = "Unknown error"; break;
            }
            include 'Error-user.php';
        }
    }
}
