<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-03
 * Time: 18:43
 */

namespace Controllers;
use Core\App;
use Models\Game;

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
    public function over(){
        return App::view('game-over');
    }

    public function lobby()
    {
        $game = new Game($this->currentUser->id);
        if(isset($_POST['turn'])){
            $game->makeTurn();
        }
        $variables = ['game' => $game];
        return App::view('lobby', $variables);
    }

    private function assignWorkers($data){
        $user_id = $this->currentUser->id;
        $SQL = "DELETE FROM worker_project WHERE `user_id` = $user_id";
        $this->connection->query($SQL);
        $values = [];
        foreach ($data as $project_id => $workers){
            foreach ($workers as $worker_id){
                $values[] = "('$user_id', '$worker_id', '$project_id')";
            }
        }
        $values = implode(', ', $values);
        $SQL = "INSERT INTO worker_project (`user_id`, `worker_id`, `project_id`) VALUES $values;";
        $this->connection->query($SQL);
    }

    public function projects()
    {
        if(isset($_POST['workers'])){
            $this->assignWorkers($_POST['workers']);
        }
        $variables = [];
        $game = new Game($this->currentUser->id);
        $variables['dashboard'] = $game->getDashboard();
        $variables['workers'] = $game->getWorkers();
        return App::view('projects', $variables);
    }

}