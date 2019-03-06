<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-04
 * Time: 17:00
 */

namespace Models;

use Core\Database;

class Project
{
    public $id;
    public $title;
    public $duration;
    public $award;
    public $size;
    private $workers = false;
    private $connection;
    private $user_id;

    public function __construct($params)
    {
        $this->id = $params['id'];
        $this->user_id =  $params['user_id'];
        $this->title = $params['title'];
        $this->duration = $params['duration'];
        $this->award = $params['award'];
        $this->size = $params['size'];
        if(isset($params['workers'])){
            $this->workers = $params['workers'];
        }
        $this->connection = Database::get_instance();

    }

    public function getAssignedWorkers()
    {
        if($this->workers){
            return $this->workers;
        }else {
            $workers = [];
            $SQL = "SELECT `id`, `name`, `level`, `job`, `sex`, `salary`, `power` FROM workers INNER JOIN worker_project ON `id` = worker_project.worker_id WHERE project_id = '$this->id' ";
            $result = $this->connection->query($SQL);
            if($result){
                foreach ($result as $row) {

                    $params = [
                        'id' => $row['id'],
                        'user_id' => $this->user_id,
                        'name' => $row['name'],
                        'level' => $row['level'],
                        'job' => $row['job'],
                        'sex' => $row['sex'],
                        'salary' => $row['salary'],
                        'power' => $row['power']
                    ];
                    $workers[] = new Worker($params);
                }
            }

            $this->workers = $workers;
            return $workers;
        }

    }

    public function saveProgress($size)
    {
        $duration = $this->duration - 1;
        $SQL = "UPDATE projects SET `duration` = '$duration', `size` = '$size' WHERE id = '$this->id';";
        $this->connection->query($SQL);
        $this->duration = $duration;
        $this->size = $size;
    }

    public function finish()
    {
        $this->connection->query("DELETE FROM `projects` WHERE `id` = '$this->id';");
        $this->connection->query("DELETE FROM `worker_project` WHERE `project_id` = '$this->id';");

    }
}