<?php

namespace QI\SistemaDeChamados\Model\Repository;

class CallRepository{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }
}