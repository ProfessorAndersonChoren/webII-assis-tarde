<?php

namespace QI\SistemaDeChamados\Model\Repository;

use QI\SistemaDeChamados\Model\Call;

class CallRepository{
    private $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    /**
     * Insert a new Call in database
     * @param Call $call
     * @return bool
     */
    public function insert($call){
        $date = $call->open_date->format("Y-m-d");
        $stmt = $this->connection->prepare("insert into calls values (null,?,null,?,?,?,?);");
        $stmt->bindParam(1, $date);
        $stmt->bindParam(2, $call->user->id);
        $stmt->bindParam(3, $call->equipment->pc_number);
        $stmt->bindParam(4, $call->description);
        $stmt->bindParam(5, $call->notes);
        return $stmt->execute();
    }
}