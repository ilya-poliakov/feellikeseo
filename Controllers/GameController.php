<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-03
 * Time: 18:43
 */

namespace Controllers;
use Core\App;


class GameController extends Controller
{
    public function start(){
        if(isset($_POST['company_name'])){
            if(isset($_SESSION['current_user_id'])){
                $user_id = $_SESSION['current_user_id'];
                $company_name = $_POST['company_name'];
                $this->connection->query("DELETE FROM `games` WHERE `user_id` = '$user_id';");
                $this->connection->query("INSERT INTO `games` (`user_id`, `company_name`) VALUES ('$user_id','$company_name');");
                header('Location: /game/lobby');
            }else{
                header('Location: /');
            }
        }
        return App::view('start');
    }

    public function lobby(){
        return App::view('lobby');
    }
}