<?php

class UserModel
{
    private $id;
    private $name;
    private $firstname;
    private $email;
    private $password;

    //Constructeur
    public function __construct($name, $firstname, $email, $password)
    {
        $this->name = $name;
        $this->firstname = $firstname;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->email = $email;
    }

    //Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname; 
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}