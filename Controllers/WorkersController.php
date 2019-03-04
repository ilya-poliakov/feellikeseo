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
    private $connection;
    public function __construct()
    {
        $this->connection = Database::get_instance();

    }

    public function hire(){
        if(isset($_POST['workers'])){
            $this->create($_POST['workers']);
        }
        $workers = $this->generate();
        return App::view('hire', $workers);
    }

    public function generate()
    {
        $file = fopen(__DIR__.'/../assets/name_worker.txt', 'r');
        $text = fgets($file);
        $array1 = explode(' ', $text);
        $sum_job = 0;
        $speed = 120;
        $coef = 100;
        $k1 = 0.5;
        $k2 = 0.75;
        $k3 = 1;
        $salary_j = 800;
        $salary_m = 1200;
        $salary_s = 1800;
        $workers = [];
        $name = [];

        for ($i=0; $i <10; $i++) {
            $name[$i]=$array1[rand(0,50)];

            if (substr($name[$i], 0, 2) == "Mr") {
                $sex = "male";
            } else $sex = "female";

            $input_lvl = ["Junior", "Middle", "Senior"];
            $lvl = $input_lvl[rand(0, 2)];

            $input_job = ["developer", "sales-manager"];
            $job = $input_job[rand(0, 1)];

            if ($job == "sales-manager") {
                $sum_job++;
                $num = $coef;
            } else {
                $num = $speed;
            }
            if ($lvl == "Junior") {
                $pay = $salary_j;
                $res = $k1 * $num;
            } elseif ($lvl == "Middle")
            { $pay = $salary_m;
                $res = $k2 * $num;
            } else {
                $pay = $salary_s;
                $res = $k3 * $num;
            }
            if ($sum_job == 10) $job = "developer";
            $workers[$i] = ['name' => $name[$i],'sex'=> $sex,'level'=> $lvl,'job'=> $job,'salary'=> $pay, 'power' => $res];
        }
        return $workers;
    }

    public function create($workers)
    {
        if(isset($_SESSION['current_user_id']))
        {
            $values = [];
            $user_id = $_SESSION['current_user_id'];
            foreach ($workers as $worker){
                $worker = json_decode($worker);
                $name = $worker->name;
                $sex = $worker->sex;
                $level = $worker->level;
                $job = $worker->job;
                $salary = $worker->salary;
                $power = $worker->power;
                $values[] = "('$user_id', '$name', '$level', '$job', '$sex', '$salary', '$power')";
            }
            $values = implode(', ', $values);
            $SQL = "INSERT INTO workers (`user_id`, `name`, `level`, `job`, `sex`, `salary`, `power`) VALUES $values;";
            $this->connection->query($SQL);
        }else {
            header('Location: /user/login');
        }

    }
}