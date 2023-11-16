<?php

namespace QI\SistemaDeChamados\Model\Repository;

use \PDO;

class Connection{
    private static $connection;

    private function __construct(){}
    
    public static function getConnection(){
        if(self::$connection == null){
            self::$connection = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        }
        return self::$connection;
    }
}