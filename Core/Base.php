<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-02-28
 * Time: 08:36
 */

namespace Core;


class Base
{
    public static function getViewTemplate($template, $variables = array(), $print = false){
        $filePath = __DIR__.'/../Views/'.$template.'.php';
        $output = '';
        if(file_exists($filePath)){
            extract($variables);
            ob_start();

            include $filePath;

            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        return $output;
    }
}