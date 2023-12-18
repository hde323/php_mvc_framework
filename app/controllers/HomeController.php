<?php

namespace app\controllers;

use src\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->Response->view('home');
    }
}
