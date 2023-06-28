<?php
require_once("./models/UserModel.php");
require_once("./repositories/UserRepository.php");

class UserController
{
    private  $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function register($data)
    {
        $validator = new UserValidator($data);
        $errors = $validator->validate();
        if ($validator->hasErrors()) {
            $errorMessages = $validator->getErrors();
            include("./views/register.php");
            return;
        }

        $foundUser = $this->userRepository->getUserByEmail($data['email']);

        if (!$foundUser) {
            $user = new UserModel($data["name"], $data["firstname"], $data["email"], $data["password"]);
            $this->userRepository->save($user);
            header("Location: ./login");
        } else {
            $errorMessages[0] = "utilisateur déja existant";
            include_once("./views/register.php");
        }
    }

    public function login($data)
    {
        $validator = new UserValidator($data);
        $validator->validateLogin();

        if ($validator->hasErrors()) {
            $errorMessages = $validator->getErrors();
            include_once("./views/login.php");
            return;
        }

        $foundUser = $this->userRepository->getUserByEmail($data['email']);

        if ($foundUser && password_verify($data["password"], $foundUser["password"])) {
            $_SESSION['user_id'] = $foundUser['id'];
            $_SESSION['user_firstname'] = $foundUser["firstname"];
            header("Location: ./dashboard");
        } else {
            $errorMessages[1] = "Cette adresse email ne correspond à aucun compte.";
            include_once("./views/login.php");
        }
    }

    public function authGuard()
    {
        if (isset($_SESSION["user_id"])) {
            $user = $this->userRepository->getUserById($_SESSION["user_id"]);
            if ($user) {
                return;
            } else {
                header("Location: ./login");
            }
        } else {
            header("Location: ./login");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ./login");
    }

    public function getPokemons(){
        $pokemons = $this->userRepository->getAllPokemons();
        include_once("./views/dashboard.php");
    }
}
