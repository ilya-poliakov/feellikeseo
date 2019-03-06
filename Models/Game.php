<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-04
 * Time: 17:00
 */


namespace Models;

require_once 'Project.php';
require_once 'Worker.php';

use Core\Database;
use Models\Worker;
use Models\Project;
use Models\User;

class Game
{
    private $connection;

    public $id;
    public $company_name;
    public $money;
    public $turn;
    private $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
        $this->connection = Database::get_instance();
        $SQL = "SELECT id, company_name, money, turn FROM games WHERE user_id = '$user_id'";
        $result = $this->connection->query($SQL);
        $row = $result->fetch_assoc();
        if(count($row)){
            $this->id = $row['id'];
            $this->company_name = $row['company_name'];
            $this->money = $row['money'];
            $this->turn = $row['turn'];
        }
    }

    public function makeTurn()
    {
        $salary = 0;
        $SQL = "SELECT SUM(salary) as `outcome` FROM workers WHERE user_id = '$this->user_id';";
        $result = $this->connection->query($SQL)->fetch_assoc();
        if($result) $salary += $result['outcome'];
        $rent = 0;
        $SQL = "SELECT SUM(rent) as `rent` FROM offices WHERE user_id = '$this->user_id';";
        $result = $this->connection->query($SQL)->fetch_assoc();
        if($result) $rent += $result['rent'];
        $income = 0;
        $projects = $this->getProjects();
        foreach ($projects as $project){
            $size = $project->size;
            $progress = 0;
            $workers = $project->getAssignedWorkers();
            foreach ($workers as $worker){
                $progress += $worker->power / $worker->getActiveProjectsCount();
            }
            $volume = $size - $progress;
            if($volume > 0){
                if($project->duration <= 1){
                    $project->finish();
                }else{
                    $project->saveProgress($volume);
                }
            }else{
                $income += $project->award;
                $project->finish();
            }
        }
        $this->turn++;


        $this->money = $this->money + $income - $rent - $salary;
        $SQL = "UPDATE games SET `turn` = '$this->turn', `money` = '$this->money' WHERE id = '$this->id';";
        $this->connection->query($SQL);
        if($this->money <= 0){
            header('Location: /game/over');
        }


    }

    /**
     * @return array[Project]
     */
    public function getProjects()
    {
        $projects = [];
        $SQL = "SELECT `id`, `title`, `size`, `duration`, `award` FROM projects  WHERE user_id = '$this->user_id'";
        $result = $this->connection->query($SQL);
        foreach ($result as $row) {
            $params = [
                'id' => $row['id'],
                'user_id' => $this->user_id,
                'title' => $row['title'],
                'size' => $row['size'],
                'duration' => $row['duration'],
                'award' => $row['award'],
            ];
            $projects[] = new Project($params);
        }
        return $projects;
    }

    public function getWorkers()
    {
        $workers = [];
        $SQL = "SELECT `id`, `name`, `level`, `job`, `sex`, `salary`, `power` FROM workers WHERE user_id = '$this->user_id'";
        $result = $this->connection->query($SQL);
        foreach ($result as $row) {
            $params = [
                'id' => $row['id'],
                'user_id' => $this->user_id,
                'name' => $row['name'],
                'level' => $row['level'],
                'job' => $row['job'],
                'sex' => $row['sex'],
                'salary' => $row['salary'],
                'power' => $row['power'],
            ];
            $workers[] = new Worker($params);
        }
        return $workers;
    }

    public function over(){

    }

    public function getDashboard()
    {
        $dashboard = [];
        $workers = [];

        $SQL = "SELECT
                projects.id,
                projects.title,
                projects.award,
                projects.size,
                projects.duration,
                workers.id as `worker_id`,
                workers.name,
                workers.level,
                workers.job,
                workers.sex,
                workers.salary,
                workers.power
                FROM projects
                LEFT JOIN worker_project ON projects.id = worker_project.project_id
                LEFT JOIN workers ON worker_id = workers.id
                WHERE projects.user_id = '$this->user_id';";

        $result = $this->connection->query($SQL);
        if($result){
            foreach ($result as $row) {
                $workers[$row['id']][$row['worker_id']] = new Worker([
                    'id' => $row['worker_id'],
                    'user_id' => $this->user_id,
                    'name' => $row['name'],
                    'level' => $row['level'],
                    'job' => $row['job'],
                    'sex' => $row['sex'],
                    'salary' => $row['salary'],
                    'power' => $row['power']
                ]);
                $dashboard[$row['id']] = new Project([
                    'id' => $row['id'],
                    'user_id' => $this->user_id,
                    'title' => $row['title'],
                    'size' => $row['size'],
                    'duration' => $row['duration'],
                    'award' => $row['award'],
                    'workers' => $workers[$row['id']]
                ]);
            }
        }


        return $dashboard;

    }


}