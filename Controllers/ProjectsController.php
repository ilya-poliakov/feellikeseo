<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-02
 * Time: 14:56
 */

namespace Controllers;


use Core\App;
use Core\Database;

class ProjectsController
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

    public function bids(){
        $porjects = $this->generate();
        return App::view('hire', $porjects);
    }

    public function generate()
    {
        $porjects = array();
        $porjects['test'] = 'test project';
        return $porjects;
    }

    public function bid()
    {
        $user_id = 1; //default value
        $this->connection->query('SQL');
        // сохранить выбранного рабочего в БД

    }
}