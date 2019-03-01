<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-02-27
 * Time: 09:39
 */
function CoreAutoloader($classname) {
    $lastSlash = strpos($classname, '\\') + 1;
    $classname = substr($classname, $lastSlash);
    $directory = str_replace('\\', '/', $classname);
    $filename = __DIR__ . '/' . $directory . '.php';
    if(file_exists($filename)){
        require_once($filename);
    }
}
spl_autoload_register('autoloader');