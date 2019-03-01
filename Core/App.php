<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-02-28
 * Time: 08:21
 */

namespace Core;


class App extends Base
{
    private $capsule;
    public $controller;
    public $model;
    public $view_render;
    public $param;
    public $method;

    public function path_split($path)
    {
        $this->capsule = explode('/', ltrim($path));
        return $this->capsule;
    }
    public static function is_home($path)
    {
        if ($path == '/') return true;

        return false;
    }
    public static function view($template_name, $data = array())
    {

          return App::getViewTemplate($template_name, $data);
    }
}