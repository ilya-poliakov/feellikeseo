<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-02-28
 * Time: 09:19
 */
namespace Controllers;

use Core\App;

class UserController
{
    public $user;

    public function register()
    {
        return App::view('register');
    }
    public function validate()
    {
        die('Validation fail');
    }
}