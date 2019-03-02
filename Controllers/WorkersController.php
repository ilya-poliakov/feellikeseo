<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-02
 * Time: 14:51
 */

namespace Controllers;

use Core\App;
use Core\Database;

class WorkersController
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

    public function hire(){
        $workers = $this->generate();
        return App::view('hire', $workers);
    }

    public function generate()
    {
        $workers = array();
        $workers['test'] = 'test worker';
        return $workers;
    }

    public function create()
    {
        $user_id = 1; //default value
        $this->connection->query('SQL');
        // сохранить выбранного рабочего в БД

    }
}