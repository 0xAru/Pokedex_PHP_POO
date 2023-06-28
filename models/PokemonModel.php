<?php
class PokemonModel
{
    private $id;
    private $image;
    private $name;
    private $type;
    private $userId;

    //Constructeur
    public function __construct($image, $name, $type)
    {
        $this->image = $image;
        $this->name = $name;
        $this->type = $type;
        $this->userId = $_SESSION["user_id"];
    }

    //Getters
    public function getId()
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getname()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    //Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }
}
