<?php
/**
 * Created by PhpStorm.
 * User: ilyapolyakov
 * Date: 2019-02-27
 * Time: 09:15
 */
namespace Core;


final class Database
{
    private static $connection = null;


    private function __construct(){

        self::$connection = mysqli_connect(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        if(self::$connection === false) {
            echo mysqli_connect_error();
        }
    }

    /**
     * connects to db and creates instance
     */
    public static function get_instance() {

        if (self::$connection === null) {
            return new self();
        }

        return self::$connection;

    }

    /**
     * access the connection
     */
    public function query($query) {
        $result =  mysqli_query(self::$connection, $query);
        if($result === false) {
            return $this->error();
        } else {
            return $result;
        }
    }

    private function error() {
        return mysqli_error(self::$connection);
    }

    public function __clone() {
        trigger_error('Can not be cloned.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Can not be deserialized.', E_USER_ERROR);
    }

}