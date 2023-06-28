<?php
session_start();
require_once("./controllers/UserController.php");
require_once("./controllers/PokemonController.php");
require_once("./controllers/UserValidator.php");

$userController = new UserController();
$pokemonController = new PokemonController();

$actionParts = isset($_SERVER['REQUEST_URI']) ? (explode('/', $_SERVER['REQUEST_URI'])) : '';

// Extraire l'action à partir de l'URL, $actionParts[0] = localhost, $actionParts[1] = POO_Login_restart, $actionParts[2] = index.php
$action = $actionParts[3];

switch ($action) {
    case "register":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->register($_POST);
        } else {
            include_once("./views/register.php");
        }
        break;

    case "login":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userController->login($_POST);
        } else {
            include_once("./views/login.php");
        }
        break;

    case 'dashboard':
        $userController->authGuard();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pokemonController->addPoke($_POST);
        }
        $userController->getPokemons();
        break;

    case 'deletePoke':
        $userController->authGuard();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pokemonController->deletePoke($_POST);
        }
        $userController->getPokemons();
        break;

    case 'logout':
        $userController->logout();
        break;

    case '':
        header("Location: ./register");
        break;

    default:
        echo ("ERROR 404");
        break;
}
