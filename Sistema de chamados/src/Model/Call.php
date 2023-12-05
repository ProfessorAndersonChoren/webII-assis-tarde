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
    private $classification;
    private $description;
    private $notes;

    /**
     * This method create a new Call object
     * @param User $user
     * @param Equipment $equipment
     * @param string $description
     * @param string $classification
     */
    public function __construct($user, $equipment, $description, $classification)
    {
        $this->user = $user;
        $this->equipment = $equipment;
        $this->description = $description;
        $this->classification = $classification;
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
