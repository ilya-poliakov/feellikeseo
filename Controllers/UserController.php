<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-02-28
 * Time: 09:19
 */
namespace Controllers;

use Core\App;
use Core\Database;

class UserController
{
    public $user;
    private $connection;
    public function __construct()
    {
        $this->connection = Database::get_instance();
//        if(isset $_SESSION['user']){
//            $this->user =
//        }
    }

    public function login(){
        return App::view('login');
    }

    public function register()
    {
        return App::view('register');
    }

    public function validate()
    {
        $username = '';
        $userEmail = '';
        $userPass = '';
        //if user created   $this->create($username, $userEmail, $userPass);
        //if errors   вывдим почему не зарегистрирован
    }

    private function create($username, $userEmail, $userPass)
    {
        //создем пользователя и выдаем главную страницу
        $this->connection->query('SQL CODE');
        return App::view('index');
    }
    public function checkuser()
    {
        $this->connection->query('SQL CODE');
        //echo 'Welcome User!';
        //echo 'Password or nickname incorrect!';
    }
}