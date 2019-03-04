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
        if(isset($_POST['office'])){
            $this->create($_POST['office']);
        }
        $offices = $this->generate();
        return App::view('offices', $offices);
    }

    public function generate()
    {
        $offices = array();
        $offices[] = array('name' => 'My Garage', 'capacity' => '3', 'comfort' => '10', 'rent' => '100');
        $offices[] = array('name' => 'Underground sanctuary', 'capacity' => '6', 'comfort' => '10', 'rent' => '250');
        $offices[] = array('name' => 'Office on the 4th floor', 'capacity' => '8', 'comfort' => '30', 'rent' => '400');
        $offices[] = array('name' => 'Lounge Studio', 'capacity' => '15', 'comfort' => '50', 'rent' => '600');
        $offices[] = array('name' => 'Full Floor Office', 'capacity' => '30', 'comfort' => '75', 'rent' => '1500');
        return $offices;
    }

    public function create($office)
    {

        if(isset($_SESSION['current_user_id']))
        {

            $user_id = $_SESSION['current_user_id'];
            $office = json_decode($office);
            $values = "('$user_id', '$office->name', '$office->capacity', '$office->comfort', '$office->rent')";
            $result = $this->connection->query("SELECT id FROM offices WHERE user_id = '$user_id';");
            if(is_null($result->fetch_assoc())){
                $SQL = "INSERT INTO offices (`user_id`, `name`, `capacity`, `comfort`, `rent`) VALUES $values;";
            }else {
                $SQL = "UPDATE offices SET `name` = '$office->name', `capacity` = '$office->capacity', `comfort` = '$office->comfort', `rent` = '$office->rent' WHERE `user_id` = '$user_id';";
            }

            $this->connection->query($SQL);
        }else {
            header('Location: /user/login');
        }

    }


}