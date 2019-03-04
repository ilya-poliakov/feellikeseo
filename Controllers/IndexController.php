<?php

namespace Controllers;

use Core\App;
use Models\User;

class IndexController extends Controller
{

    public function index()
    {
        $args = [];
        if(isset($_SESSION['current_user_id'])){
            $user = new User($_SESSION['current_user_id']);
            $args['user'] = $user;
        }
        return App::view('index', $args);
    }
}