<?php

class Connection
{
    /**
     * @var bool
     */
    public static $connection = false;

    /**
     *
     */
    private function __construct()
    {

    }

    /**
     * @param $config
     * @return bool|PDO|void
     */
    public static function connect($config)
    {
        try {
            if (!self::$connection) {
                $con = new PDO(
                    "mysql:host={$config['db']['host']};
                    dbname={$config['db']['dbname']}",
                    $config['db']['dbuser'],
                    $config['db']['dbpass']
                );
                $con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $con->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
                self::$connection = $con;
                return self::$connection;
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            throw $exception;
        }
    }
}