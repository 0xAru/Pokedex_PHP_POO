<?php
require_once("./models/PokemonModel.php");
require_once("./repositories/PokemonRepository.php");
require_once("./controllers/UserController.php");

class PokemonController
{
    private $pokemonRepository;

    public function __construct()
    {
        $this->pokemonRepository = new PokemonRepository();
    }

    private function getPoke($data)
    {
        $urlAPI = 'https://pokebuildapi.fr/api/v1/pokemon/' . $data['name'];

        // Envoyer une requête HTTP HEAD pour vérifier si la ressource existe
        $headers = get_headers($urlAPI);

        if ($headers === false || strpos($headers[0], '200') === false) {
            $pokemons = $this->pokemonRepository->getAllPokemons();
            // Gérer l'erreur de la requête
            $errorMessages[0] = "Pokemon introuvable";
            include_once("./views/dashboard.php");
            die;
        }

        // Envoyer une requête HTTP GET à l'URL de l'API
        $response = file_get_contents($urlAPI);

        // Vérifier si la requête a réussi
        if ($response === false) {
            // Gérer l'erreur de la requête
            throw new Exception("Erreur lors de la récupération des données du Pokémon.");
        }

        // Décoder la réponse JSON en un tableau associatif
        $pokemonData = json_decode($response, true);

        // Vérifier si la réponse a pu être décodée
        if ($pokemonData === null) {
            // Gérer l'erreur de décodage JSON
            throw new Exception("Erreur lors du décodage de la réponse de l'API.");
        }

        // Retourner les données du Pokémon
        return $pokemonData;
    }

    public function addPoke($data)
    {
        try {
            $pokemonApi = $this->getPoke($data);


            $pokemon = new PokemonModel($pokemonApi['image'], $pokemonApi['name'], json_encode($pokemonApi['apiTypes']));

            $this->pokemonRepository->save($pokemon);

            header("Location: ./dashboard");
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            // Afficher le message d'erreur à l'utilisateur
            echo $errorMessage;
        }
    }


    public function deletePoke($data)
    {
        $pokemonId = $data['id'];

        $this->pokemonRepository->deletePokemon($pokemonId);
        header("Location: ./dashboard");
    }
}
