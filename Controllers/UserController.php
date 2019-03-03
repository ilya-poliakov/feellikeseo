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
        $email=$_POST["email"];
        $password =$_POST["password"];
        $login =$_POST["login"];
        $errors = [];
        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))){
            $errors['email'] =  "Email is not correct";
        }
        if(!ctype_alnum ($password) || strlen($password)<6 || strlen($password)>20){
            $errors['password'] =  "Password is not correct , must contain only numbers and English numbers 
    not less than six and not more than 20 characters";
        }
        $result = $this->connection->query("SELECT id FROM users WHERE email = '$email' ");
        if($result->num_rows && !isset($errors['email'])){
            $errors['email'] = 'user with such email already exists.....';
        }
        $result = $this->connection->query("SELECT id FROM users WHERE login = '$login' ");
        if($result->num_rows){
            $errors['login'] = 'user with such login already exists.....';
        }
        if(count($errors)){
            return App::view('register', $errors);
        }else{
            $this->create($login, $email, $password);
        }
    }

    private function create($username, $userEmail, $userPass)
    {

        $this->connection->query("INSERT INTO `users` (`login`, `password`, `email`) VALUES ('$username', MD5('$userPass'), '$userEmail');");
        $this->checkuser();
    }
    public function checkuser()
    {
        $password = $_POST["password"];
        $login = $_POST["login"];
        $password = md5($password);
        $errors = [];
        $this->connection->query('SQL CODE');
        $result = $this->connection->query("SELECT id FROM users WHERE login = '$login' AND password = '$password'");
        if(!$result->num_rows){
            $errors['password'] = 'login/password incorrect';
        }
        if(count($errors)){
            return App::view('login', $errors);
        } else{
            $rows = $result->fetch_all();
            $_SESSION['current_user_id'] = $rows[0][0];
            return App::view('index', $errors);
        }
    }
}