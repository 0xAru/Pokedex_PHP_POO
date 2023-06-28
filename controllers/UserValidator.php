<?php

class UserValidator {
    private $data;
    private $errors = [];

    public function __construct($data){
        $this->data = $data;
    }

    public function validate(){
        $this->validateName();
        $this->validateFirstname();
        $this->validateEmail();
        $this->validatePassword();
        return $this->errors;
    }

    public function validateName(){
        $name = $this->data['name'];

        if (empty($name)) {
            $this->addError("name", "Le nom est requis.");
        } else {
            $validatedName = htmlspecialchars($name);

            if ($validatedName !== $name) {
                $this->addError('name', "Le nom contient des caractères spéciaux non autorisés.");
            }
        }
    }

    public function validateFirstname() {
        $firstname = $this->data["firstname"];

        if (empty($firstname)) {
            $this->addError("firstname", "Le prénom est requis");
        } else {
            $validatedFirstname = htmlspecialchars($firstname);

            if ($validatedFirstname !== $firstname) {
                $this->addError('firstname', 'Le prénom contient des caractères non autorisés');
            }
        }
    }

    public function validateEmail(){
        $email = $this->data["email"];

        if (empty($email)) {
            $this->addError("email", "L'adresse email est requise.");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->addError("email", "L'adresse email est invalide.");
        }
    }

    private function validatePassword(){
        $password = $this->data["password"];

        if (empty($password)) {
            $this->addError("password", "Le mot de passe est requis.");

        } else if (!preg_match('/^(?=.*[A-Z])(?=.*\d)[A-Z][A-Za-z\d?!\(\)\-\/\\\\_]{7,}$/', $password)) {
            $this->addError("password", "Le mot de passe doit être composé d'au moins 8 caractères, commencer par une majuscule et contenir au moins un chiffre.");
        }
    }

    private function addError($field, $message){
        $this->errors[$field] = $message;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function validateLogin(){
        $this->validateEmail();
        $this->validatePassword();
    }
}