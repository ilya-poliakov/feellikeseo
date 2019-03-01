<?php

namespace Controllers;

use Core\App;

class IndexController
{
    function __construct()
    {

    }
    public function index()
    {
        return App::view('index');
    }
}