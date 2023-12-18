<?php

namespace src;

use InvalidArgumentException;
use src\Request;

class Controller
{
   protected Request $Request;
   protected Response $Response;

   public function __construct()
   {
      $this->Request = new Request($_SERVER,$_POST,$_GET);
      $this->Response = new Response();
   }
}
