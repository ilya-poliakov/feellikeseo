<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-04
 * Time: 17:00
 */

namespace Models;
use Core\Database;
use Models\Project;

class Worker
{
    private $connection;

    public $id;
    public $name;
    public $level;
    public $job;
    public $sex;
    public $salary;
    public $power;
    public $project_id;
    private $user_id;

    public function __construct($params)
    {
        $this->id = $params['id'];
        $this->user_id =  $params['user_id'];
        $this->name = $params['name'];
        $this->level = $params['level'];
        $this->job = $params['job'];
        $this->sex = $params['sex'];
        $this->salary = $params['salary'];
        $this->power = $params['power'];

        $this->connection = Database::get_instance();

    }

    public function getActiveProjects(){

    }

    public function getActiveProjectsCount(){
        $count = 0;
        $SQL = "SELECT COUNT(project_id) as `projects_count` FROM worker_project WHERE `worker_id` = '$this->id';";
        $result = $this->connection->query($SQL)->fetch_assoc();
        if($result) $count += $result['projects_count'];
        return $count;
    }
}