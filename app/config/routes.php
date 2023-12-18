<?php

use app\controllers\HomeController;
use src\Router;

$Router = new Router();

//declare your routes here
$Router->Get('/',[new HomeController,'index']);
