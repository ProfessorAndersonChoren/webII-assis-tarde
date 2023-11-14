<?php

namespace QI\SistemaDeChamados\Model;
class User{
    private $id;
    private $name;
    private $email;
    private $password;

    /**
     * This method create a new User object
     * @param string $email This is user email
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    public function __get($attribute){
        return $this->$attribute;
    }

    public function __set($attribute,$value){
        $this->$attribute = $value;
    }
}