<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-03-02
 * Time: 14:56
 */

namespace Controllers;


use Core\App;

class ProjectsController extends Controller
{
    public $user;

    public function bids(){
        if(isset($_POST['projects'])){
            $this->bid($_POST['projects']);
        }
        $porjects = $this->generate();
        return App::view('bids', $porjects);
    }

    public function generate()
    {

        $projects = [];
        $names = file(__DIR__.'/../assets/name_project.txt',FILE_IGNORE_NEW_LINES);
        for ($i=0; $i < 10; $i++) {
            $title = $names[array_rand($names)];
            $size = rand(5, 50) * 10;
            $duration = round($size / rand(50, 120));
            $award = $size * rand(10, 20);
            $projects[] = array('title' => $title, 'size' => $size, 'duration' => $duration, 'award' => $award);
        }
        return $projects;
    }

    public function bid($projects)
    {
        if(isset($_SESSION['current_user_id']))
        {
            $values = [];
            $user_id = $_SESSION['current_user_id'];
            foreach ($projects as $project){
                $project = json_decode($project);
                $title = $project->title;
                $duration = $project->duration;
                $size = $project->size;
                $award = $project->award;
                $values[] = "('$user_id', '$title', '$size', '$duration', '$award')";
            }
            $values = implode(', ', $values);
            $SQL = "INSERT INTO projects (`user_id`, `title`, `size`, `duration`, `award`) VALUES $values;";
            $this->connection->query($SQL);
        }else {
            header('Location: /user/login');
        }
    }
}