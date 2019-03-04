<?php
namespace Controllers;

use Core\App;
use Core\Database;

class Controller
{
    protected $connection;

    public function __construct()
    {
        $this->connection = Database::get_instance();
    }
}