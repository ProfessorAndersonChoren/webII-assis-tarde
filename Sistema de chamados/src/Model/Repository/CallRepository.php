<?php

namespace QI\SistemaDeChamados\Model\Repository;

use QI\SistemaDeChamados\Model\Call;
use \PDO;

class CallRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    /**
     * Insert a new Call in database
     * @param Call $call
     * @return bool
     */
    public function insert($call)
    {
        $date = $call->open_date->format("Y-m-d");
        $stmt = $this->connection->prepare("call insertCall(?,?,?,?,?,?);");
        $stmt->bindParam(1, $date);
        $stmt->bindParam(2, $call->user->id);
        $stmt->bindParam(3, $call->equipment->pc_number);
        $stmt->bindParam(4, $call->classification);
        $stmt->bindParam(5, $call->description);
        $stmt->bindParam(6, $call->notes);
        return $stmt->execute();
    }

    /**
     * Return all calls
     * @return array
     */
    public function findAll()
    {
        $stmt = $this->connection->query("select c.*,u.name from calls c inner join users u on c.user_id = u.id order by classification desc;");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function findOne($id){
        $stmt = $this->connection->query("select * from calls where id=$id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function delete($id){
        $stmt = $this->connection->prepare("delete from calls where id=?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
