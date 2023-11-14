<?php

namespace QI\SistemaDeChamados\Model;

use \DateTime;

class Call
{
    private $id;
    private $open_date;
    private $last_modify_date;
    private $user;
    private $equipment;
    private $description;
    private $notes;

    /**
     * This method create a new Call object
     * @param DateTime $open_date
     * @param User $user
     * @param Equipment $equipment
     * @param string $description
     */
    public function __construct($open_date, $user, $equipment, $description)
    {
        $this->open_date = $open_date;
        $this->user = $user;
        $this->equipment = $equipment;
        $this->description = $description;
    }

    public function __get($attribute)
    {
        return $this->$attribute;
    }

    public function __set($attribute, $value)
    {
        $this->$attribute = $value;
    }
}
