<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-02
 * Time: 14:23
 */

namespace Controllers;

use Core\App;
use Core\Database;

class OfficeController
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

    public function choose(){
        $offices = $this->generate();
        return App::view('offices', $offices);
    }

    public function generate()
    {
        $offices = array();
        $offices['test'] = 'test office';
        return $offices;
    }

    public function create()
    {
        $user_id = 1; //default value
        $this->connection->query('SQL');
        // сохранить выбранный оффис в БД

    }


}