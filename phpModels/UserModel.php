<?php
class UserModel
{
    /* 
    Columns:
        acc_id int(11) AI PK 
        name varchar(20) 
        pass varchar(20) 
        email varchar(100) 
        type varchar(20)
    */
    private $acc_id;
    private $name;
    private $email;
    private $type;

    public function __construct($acc_id, $name, $email, $type)
    {
        $this->acc_id = $acc_id;
        $this->name = $name;
        $this->email = $email;
        $this->type = $type;
    }

    function getAccID()
    {
        return $this->acc_id;
    }

    function getName()
    {
        return $this->name;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getType()
    {
        return $this->type;
    }
}
