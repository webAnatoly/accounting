<?php

namespace Config;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


/**
 * The Singleton class defines the `GetInstance` method that serves as an
 * alternative to constructor and lets clients access the same instance of this
 * class over and over.
 */
class Config {

    /**
     * The Singleton's instance is stored in a static field. This field is an
     * array, because we'll allow our Singleton to have subclasses. Each item in
     * this array will be an instance of a specific Singleton's subclass.
     */
    private static $instance = [];
    private static $conn = NULL;

    /**
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    protected function __construct() {
        // The expensive process (e.g.,db connection) goes here.
        if ($_SERVER['SERVER_NAME'] == "localhost")
        {
            // для запуска на локальной машине
            // $user = "tlk";
            // $pass = "z,kjrj";
            // $db_name = "accounting";
            // $host = "localhost:3306";

            $user = "tlk";
            $pass = "z,kjrj";
            $db_name = "accounting";
            $host = "localhost:3306"; // 172.20.0.1 - ip адрес докер контейнера полученный командой docker inspect <container_name> | grep Gateway

            // $user = "user";
            // $pass = "test";
            // $db_name = "accountingDb";
            // $host = "mysql_my_marlin_project_1:3306";
        } else {
            //тут данные удаленного хоста
            $user = "";
            $pass = "";
            $db_name = "";
            $host = "localhost";
        }

        $db = new \mysqli($host, $user, $pass, $db_name);
        self::$conn = $db;
    }

    /**
     * Singletons should not be cloneable.
     */
    protected function __clone() { }

    /**
     * Singletons should not be restorable from strings.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     *  The object is created from within the class itself only if the class has no instance.
     */
    private static function getInstance()
    {
        if (empty(self::$instance) == true)
        {
            self::$instance = new Config();
        }
    
        return self::$instance;
    }


    /** Подключение к базе.*/
    static public function getDb()
    {
        self::getInstance();
        return self::$conn;
    }

}