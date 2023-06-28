<?php
include_once('./database.php');

class PokemonRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function save(PokemonModel $pokemon)
    {
        $image = $pokemon->getImage();
        $name = $pokemon->getname();
        $type = $pokemon->getType();
        $userId = $pokemon->getUserId();

        $query = "INSERT INTO pokemon (image, name, type, user_id) VALUE (:image, :name, :type, :userId)";
        $sth = $this->db->getConnection()->prepare($query);

        $sth->bindParam(':image', $image);
        $sth->bindParam(':name', $name);
        $sth->bindParam(':type', $type);
        $sth->bindParam(':userId', $userId);

        $sth->execute();
        $pokeData = $sth->fetch(PDO::FETCH_ASSOC);
        return $pokeData;
    }

    public function getPokemonByName($name)
    {
        $sthPokeName = $this->db->getConnection()->prepare("SELECT * FROM pokemon WHERE name = :name");
        $sthPokeName->bindParam(':name', $name);
        $sthPokeName->execute();
        $result = $sthPokeName->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deletePokemon($data)
    {
        $pokemonId = $data;
        $sthPoke = $this->db->getConnection()->prepare("DELETE FROM pokemon WHERE id = :id");
        $sthPoke->bindParam(':id', $pokemonId);
        $sthPoke->execute();
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
