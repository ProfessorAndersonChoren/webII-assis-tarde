<?php

namespace QI\SistemaDeChamados\Model;

class Equipment
{
    private $pc_number;
    private $floor;
    private $room;

    /**
     * This method create a new Equipment object
     * @param string $pc_number
     * @param int $floor
     * @param int $room
     */
    public function __construct($pc_number, $floor, $room)
    {
        $this->pc_number = $pc_number;
        $this->floor = $floor;
        $this->room = $room;
    }

    public function __get($attribute){
        return $this->$attribute;
    }

    public function __set($attribute, $value)
    {
        $this->$attribute = $value;
    }
}
