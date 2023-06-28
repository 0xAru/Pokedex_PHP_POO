<?php
include_once("./database.php");

class UserRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function save(UserModel $user)
    {
        $name = $user->getName();
        $firstname = $user->getFirstname();
        $email = $user->getEmail();
        $password = $user->getPassword();

        $query = "INSERT INTO user (name, firstname, email, password) VALUE (:name, :firstname, :email, :password)";
        $sth = $this->db->getConnection()->prepare($query);

        $sth->bindParam(":name", $name);
        $sth->bindParam(":firstname", $firstname);
        $sth->bindParam(":email", $email);
        $sth->bindParam(":password", $password);

        $sth->execute();
        $userData = $sth->fetch(PDO::FETCH_ASSOC);
        return $userData;
    }

    public function getUserByEmail($email)
    {
        $sthCheckEmail = $this->db->getConnection()->prepare("SELECT * FROM user WHERE email = :email");
        $sthCheckEmail->bindParam(":email", $email);
        $sthCheckEmail->execute();
        $result = $sthCheckEmail->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserById($id)
    {
        $sthUserId = $this->db->getConnection()->prepare("SELECT *FROM user WHERE id = :id");
        $sthUserId->bindParam(":id", $id);
        $sthUserId->execute();
        $result = $sthUserId->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getAllPokemons()
    {
        $userId = $_SESSION["user_id"];
        $sthPokemons = $this->db->getConnection()->prepare("SELECT * FROM pokemon WHERE user_id = :userId");
        $sthPokemons->bindParam(':userId', $userId);
        $sthPokemons->execute();
        $result = $sthPokemons->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $pokemon) {
            $pokemon["type"] = json_decode($pokemon["type"]);
        }
        return $result;
    }
}
