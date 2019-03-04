<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-01
 * Time: 19:47
 */
namespace Models;

use Core\App;
use Core\Database;

class User
{
    private $connection;
    public $id;
    public $login;
    public $email;


    public function __construct($user_id)
    {
        $this->connection = Database::get_instance();
        $this->id = $user_id;
        $result = $this->connection->query("SELECT login, email FROM users WHERE id = '$user_id'");
        $row = $result->fetch_assoc();
        $this->email = $row['email'];
        $this->login = $row['login'];

    }
}