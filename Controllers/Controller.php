<?php
namespace Controllers;

use Core\App;
use Core\Database;
use Models\User;

class Controller
{
    protected $currentUser;
    protected $connection;

    public function __construct()
    {
        if(isset($_SESSION['current_user_id'])){
            $this->currentUser = new User($_SESSION['current_user_id']);
        }
        $this->connection = Database::get_instance();
    }
}