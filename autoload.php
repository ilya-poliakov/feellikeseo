<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-02-27
 * Time: 19:04
 */
function autoloader($classname) {
    $lastSlash = strpos($classname, '\\');
    $classname = substr($classname, $lastSlash);
    $directory = str_replace('\\', '/', $classname);
    $subfolder = __DIR__ .'/Core/';
    $filename = $subfolder. $directory . '.php';
//    if(!file_exists($filename)) {
//        $subfolder = __DIR__ . '/Controllers/';
//        $filename = $subfolder . $directory . '.php';
//    } elseif(!file_exists($filename)){
//        $subfolder = __DIR__ . '/Models/';
//        $filename = $subfolder . $directory . '.php';
//    }
    if(file_exists($filename)){
        require_once($filename);
    }
}
spl_autoload_register('autoloader');